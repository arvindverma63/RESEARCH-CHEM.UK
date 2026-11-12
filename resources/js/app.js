import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { createIcons, icons } from 'lucide';

Alpine.plugin(collapse);

const CART_STORAGE_KEY = 'stripe-cart';

function loadStoredCart() {
    try {
        const saved = localStorage.getItem(CART_STORAGE_KEY);
        if (saved) {
            const parsed = JSON.parse(saved);
            return Array.isArray(parsed) ? parsed : [];
        }
    } catch (e) {
        console.warn('Failed to parse cart from storage:', e);
    }
    return [];
}

function persistCart(items) {
    try {
        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(items || []));
    } catch (e) {
        console.warn('Failed to save cart to storage:', e);
    }
}

// Global Cart & Shop Store
Alpine.store('cart', {
    items: loadStoredCart(),
    addedToast: false,
    toastMessage: '',
    _toastTimer: null,

    init() {
        if (!Array.isArray(this.items) || this.items.length === 0) {
            this.items = loadStoredCart();
        }
    },

    save() {
        persistCart(this.items);
    },

    count() {
        return (this.items || []).reduce((sum, item) => sum + (Number(item.quantity) || 1), 0);
    },

    subtotal() {
        return (this.items || []).reduce((sum, item) => sum + ((Number(item.price) || 0) * (Number(item.quantity) || 1)), 0);
    },

    isSarm(item) {
        const sarmsSlugs = ['mk-677-ibutamoren', 'rad-140-testolone', 'yk-11-myostine', 'lgd-4033-ligandrol', 'mk-2866-ostarine', 'gw-501516-cardarine'];
        const idStr = String(item.id || '');
        return idStr.startsWith('sarm-') || sarmsSlugs.some(s => idStr.includes(s)) || item.category === 'sarms';
    },

    sarmsItems() {
        return (this.items || []).filter(i => this.isSarm(i));
    },

    vialItems() {
        return (this.items || []).filter(i => !this.isSarm(i));
    },

    sarmsQty() {
        return this.sarmsItems().reduce((s, i) => s + (Number(i.quantity) || 1), 0);
    },

    vialQty() {
        return this.vialItems().reduce((s, i) => s + (Number(i.quantity) || 1), 0);
    },

    sarmsSubtotal() {
        return this.sarmsItems().reduce((s, i) => s + ((Number(i.price) || 0) * (Number(i.quantity) || 1)), 0);
    },

    vialSubtotal() {
        return this.vialItems().reduce((s, i) => s + ((Number(i.price) || 0) * (Number(i.quantity) || 1)), 0);
    },

    sarmsPct() {
        const q = this.sarmsQty();
        return q >= 6 ? 20 : q >= 3 ? 10 : 0;
    },

    vialPct() {
        const q = this.vialQty();
        return q >= 10 ? 20 : q >= 5 ? 10 : 0;
    },

    sarmsDiscount() {
        return Math.round(this.sarmsSubtotal() * this.sarmsPct() / 100);
    },

    vialDiscount() {
        return Math.round(this.vialSubtotal() * this.vialPct() / 100);
    },

    totalDiscount() {
        return this.sarmsDiscount() + this.vialDiscount();
    },

    discountedTotal() {
        return Math.max(0, this.subtotal() - this.totalDiscount());
    },

    shippingFee() {
        return this.discountedTotal() >= 5000 ? 0 : 650;
    },

    finalTotal() {
        return this.discountedTotal() + this.shippingFee();
    },

    formatMoney(pence) {
        return '£' + ((Number(pence) || 0) / 100).toFixed(2);
    },

    addToCart(item) {
        if (!item || !item.id) return;
        const qty = Number(item.quantity) || 1;
        const itemId = String(item.id);
        const existing = this.items.find(i => String(i.id) === itemId);

        if (existing) {
            existing.quantity = (Number(existing.quantity) || 1) + qty;
        } else {
            this.items.push({
                id: itemId,
                name: item.name || 'Research Compound',
                price: parseInt(item.price, 10) || 0,
                currency: item.currency || 'gbp',
                priceId: itemId,
                quantity: qty,
                image: item.image || null,
                category: item.category || ''
            });
        }

        this.save();
        this.showToast(`${item.name || 'Item'} added to cart`);
    },

    updateQuantity(id, quantity) {
        const itemId = String(id);
        const idx = this.items.findIndex(i => String(i.id) === itemId);
        if (idx !== -1) {
            const q = Number(quantity);
            if (q <= 0) {
                this.items.splice(idx, 1);
            } else {
                this.items[idx].quantity = q;
            }
            this.save();
        }
    },

    removeFromCart(id) {
        const itemId = String(id);
        this.items = this.items.filter(i => String(i.id) !== itemId);
        this.save();
    },

    clearCart() {
        this.items = [];
        this.save();
    },

    showToast(msg) {
        this.toastMessage = msg;
        this.addedToast = true;
        if (this._toastTimer) {
            clearTimeout(this._toastTimer);
        }
        this._toastTimer = setTimeout(() => {
            this.addedToast = false;
        }, 3500);
    }
});

// Global PWA Store
Alpine.store('pwa', {
    deferredPrompt: null,
    isInstallable: false,
    isInstalled: false,
    isIOS: false,
    isMobile: false,
    showIOSModal: false,
    showFallbackModal: false,
    dismissed: false,

    init() {
        try {
            const isStandalone = (window.matchMedia && window.matchMedia('(display-mode: standalone)').matches)
                || window.navigator.standalone === true
                || document.referrer.includes('android-app://');
            this.isInstalled = !!isStandalone;

            this.dismissed = localStorage.getItem('rc_pwa_dismissed') === '1';

            const ua = (navigator.userAgent || '').toLowerCase();
            this.isIOS = /iphone|ipad|ipod/.test(ua) && !window.MSStream;
            this.isMobile = /android|iphone|ipad|ipod|mobile|phone/i.test(ua) || (window.innerWidth <= 768);

            // Listen for beforeinstallprompt (Chromium / Android)
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                this.deferredPrompt = e;
                this.isInstallable = true;
            });

            // Listen for appinstalled
            window.addEventListener('appinstalled', () => {
                this.isInstalled = true;
                this.isInstallable = false;
                this.deferredPrompt = null;
                try {
                    localStorage.setItem('rc_pwa_installed', '1');
                } catch (e) {}
            });
        } catch (e) {
            console.warn('[PWA] Store init error:', e);
        }
    },

    async install() {
        if (this.deferredPrompt) {
            try {
                this.deferredPrompt.prompt();
                const choice = await this.deferredPrompt.userChoice;
                if (choice && choice.outcome === 'accepted') {
                    this.isInstalled = true;
                }
                this.deferredPrompt = null;
                this.isInstallable = false;
            } catch (err) {
                console.warn('[PWA] Prompt error:', err);
            }
        } else if (this.isIOS) {
            this.showIOSModal = true;
        } else {
            this.showFallbackModal = true;
        }
    },

    dismiss() {
        this.dismissed = true;
        try {
            localStorage.setItem('rc_pwa_dismissed', '1');
        } catch (e) {}
    }
});

window.Alpine = Alpine;
Alpine.start();

// Initialize Lucide icons on page load once safely
window.refreshIcons = () => {
    try {
        createIcons({ icons });
    } catch (e) {
        // Safe fallback
    }
};

document.addEventListener('DOMContentLoaded', () => {
    window.refreshIcons();
});
