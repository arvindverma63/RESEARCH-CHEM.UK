import { z } from 'zod';
export const schemas = {
  home: z.object({
    "hero": z.object({
      "headline": z.string(),
      "subheadline": z.string(),
      "cta_primary": z.string(),
      "cta_secondary": z.string()
    }),
    "trust_signals": z.array(z.object({
      "id": z.string(),
      "label": z.string()
    })),
    "categories": z.array(z.object({
      "id": z.string(),
      "name": z.string(),
      "descriptor": z.string(),
      "compound_count": z.string(),
      "purity": z.string(),
      "cas_ref": z.string(),
      "href": z.string()
    })),
    "stats": z.array(z.object({
      "id": z.string(),
      "value": z.string(),
      "label": z.string()
    })),
    "credentials": z.array(z.object({
      "id": z.string(),
      "text": z.string()
    })),
    "cta_section": z.object({
      "headline": z.string(),
      "subtext": z.string(),
      "button": z.string()
    })
  }),
  products: z.object({
    "CATEGORIES": z.array(z.object({
      "label": z.string(),
      "value": z.string(),
      "id": z.string()
    }))
  }),
  peptides: z.object({
    "PEPTIDE_FILTERS": z.array(z.object({
      "label": z.string(),
      "value": z.string(),
      "id": z.string()
    }))
  }),
  pen_kits: z.object({
    "pageTitle": z.string(),
    "pageSubtitle": z.string(),
    "categoryIntro": z.object({
      "heading": z.string(),
      "body": z.array(z.object({
        "id": z.string(),
        "text": z.string()
      }))
    }).optional(),
    "PRODUCTS": z.array(z.object({
      "slug": z.string(),
      "name": z.string(),
      "dose": z.string(),
      "subtitle": z.string(),
      "formula": z.string(),
      "contents": z.array(z.string()),
      "tiers": z.array(z.object({
        "qty": z.string(),
        "price": z.string(),
        "each": z.string(),
        "highlight": z.boolean(),
        "id": z.string()
      })),
      "id": z.string()
    }))
  }),
  sarms_products: z.object({
    "pageTitle": z.string(),
    "pageSubtitle": z.string(),
    "discountBanner": z.string(),
    "categoryIntro": z.object({
      "heading": z.string(),
      "body": z.array(z.object({
        "id": z.string(),
        "text": z.string()
      }))
    }).optional(),
    "products": z.array(z.object({
      "id": z.string(),
      "slug": z.string(),
      "name": z.string(),
      "subtitle": z.string(),
      "concentration": z.string(),
      "volume": z.string(),
      "price": z.string(),
      "formula": z.string(),
      "cas": z.string(),
      "molecularFormula": z.string(),
      "molecularWeight": z.string(),
      "purity": z.string(),
      "solvent": z.string(),
      "appearance": z.string(),
      "storage": z.string(),
      "chemDesc": z.string()
    }))
  }),
  peptide_vials: z.object({
    "pageTitle": z.string(),
    "pageSubtitle": z.string(),
    "discountBanner": z.string(),
    "categoryIntro": z.object({
      "heading": z.string(),
      "body": z.array(z.object({
        "id": z.string(),
        "text": z.string()
      }))
    }).optional(),
    "vials": z.array(z.object({
      "slug": z.string(),
      "name": z.string(),
      "dose": z.string(),
      "price": z.string(),
      "vialSize": z.string(),
      "img": z.string(),
      "id": z.string(),
      "cas": z.string(),
      "molecularFormula": z.string(),
      "molecularWeight": z.string(),
      "purity": z.string(),
      "sequence": z.string(),
      "appearance": z.string(),
      "storage": z.string(),
      "chemDesc": z.string()
    }))
  }),
  compliance: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "eyebrow": z.string(),
      "heading": z.string(),
      "subheading": z.string()
    }),
    "about": z.object({
      "heading": z.string(),
      "body": z.array(z.object({
        "id": z.string(),
        "text": z.string()
      }))
    }),
    "disclaimers": z.array(z.object({
      "id": z.string(),
      "icon": z.string(),
      "heading": z.string(),
      "body": z.string()
    })),
    "quality": z.object({
      "heading": z.string(),
      "points": z.array(z.object({
        "id": z.string(),
        "label": z.string(),
        "detail": z.string()
      }))
    }),
    "legal": z.object({
      "heading": z.string(),
      "body": z.array(z.object({
        "id": z.string(),
        "text": z.string()
      }))
    }),
    "contact": z.object({
      "heading": z.string(),
      "body": z.string(),
      "email": z.string(),
      "cta": z.string()
    })
  }),
  privacy_policy: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "heading": z.string(),
      "updated": z.string()
    }),
    "sections": z.array(z.object({
      "id": z.string(),
      "heading": z.string(),
      "body": z.string()
    }))
  }),
  shipping_policy: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "heading": z.string(),
      "updated": z.string()
    }),
    "sections": z.array(z.object({
      "id": z.string(),
      "heading": z.string(),
      "body": z.string()
    }))
  }),
  cookie_policy: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "heading": z.string(),
      "updated": z.string()
    }),
    "sections": z.array(z.object({
      "id": z.string(),
      "heading": z.string(),
      "body": z.string()
    }))
  }),
  acceptable_use: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "heading": z.string(),
      "updated": z.string()
    }),
    "sections": z.array(z.object({
      "id": z.string(),
      "heading": z.string(),
      "body": z.string()
    }))
  }),
  disclaimer: z.object({
    "meta": z.object({
      "title": z.string(),
      "description": z.string()
    }),
    "hero": z.object({
      "heading": z.string(),
      "updated": z.string()
    }),
    "sections": z.array(z.object({
      "id": z.string(),
      "heading": z.string(),
      "body": z.string()
    }))
  }),
  pages: {
    product_detail: z.object({
      "researchBadge": z.string(),
      "disclaimer": z.object({
        "heading": z.string(),
        "body": z.string()
      }),
      "trustBadges": z.array(z.object({
        "id": z.string(),
        "label": z.string(),
        "sub": z.string()
      })),
      "addToCartLabel": z.string(),
      "addingLabel": z.string(),
      "addedLabel": z.string(),
      "viewCartLabel": z.string(),
      "inStockLabel": z.string(),
      "outOfStockLabel": z.string(),
      "productDetailsHeading": z.string(),
      "notFoundMessage": z.string(),
      "backToProductsLabel": z.string()
    }),
    cart: z.object({
      "checkout": z.object({
        "heading": z.string(),
        "namePlaceholder": z.string(),
        "emailPlaceholder": z.string(),
        "nameLabel": z.string(),
        "emailLabel": z.string(),
        "paymentNote": z.string(),
        "freeDeliveryBanner": z.string(),
        "deliveryLabel": z.string(),
        "deliveryRowLabel": z.string(),
        "freeDeliveryNote": z.string(),
        "totalLabel": z.string(),
        "redirectingLabel": z.string()
      })
    }),
    order_confirmation: z.object({
      "title": z.string(),
      "subtitle": z.string(),
      "referenceLabel": z.string(),
      "orderIdLabel": z.string(),
      "contactNote": z.string(),
      "contactEmail": z.string(),
      "backButton": z.string(),
      "dispatchNote": z.string()
    }),
    refund_policy: z.object({
      "meta": z.object({
        "title": z.string(),
        "description": z.string()
      }),
      "hero": z.object({
        "heading": z.string(),
        "updated": z.string()
      }),
      "sections": z.array(z.object({
        "id": z.string(),
        "heading": z.string(),
        "body": z.string()
      }))
    }),
    pen_kits: z.object({
      "pageTitle": z.string(),
      "pageSubtitle": z.string(),
      "PRODUCTS": z.array(z.object({
        "slug": z.string(),
        "name": z.string(),
        "dose": z.string(),
        "subtitle": z.string(),
        "formula": z.string(),
        "contents": z.array(z.string()),
        "tiers": z.array(z.object({
          "qty": z.string(),
          "price": z.string(),
          "each": z.string(),
          "highlight": z.boolean(),
          "id": z.string()
        })),
        "id": z.string()
      })),
      "categoryIntro": z.object({
        "heading": z.string(),
        "body": z.array(z.object({
          "id": z.string(),
          "text": z.string()
        }))
      })
    }),
    peptide_vials: z.object({
      "pageTitle": z.string(),
      "pageSubtitle": z.string(),
      "discountBanner": z.string(),
      "vials": z.array(z.object({
        "slug": z.string(),
        "name": z.string(),
        "dose": z.string(),
        "price": z.string(),
        "vialSize": z.string(),
        "img": z.string(),
        "id": z.string(),
        "cas": z.string(),
        "molecularFormula": z.string(),
        "molecularWeight": z.string(),
        "purity": z.string(),
        "sequence": z.string(),
        "appearance": z.string(),
        "storage": z.string(),
        "chemDesc": z.string()
      })),
      "categoryIntro": z.object({
        "heading": z.string(),
        "body": z.array(z.object({
          "id": z.string(),
          "text": z.string()
        }))
      })
    })
  }
};
export type Schemas = typeof schemas;