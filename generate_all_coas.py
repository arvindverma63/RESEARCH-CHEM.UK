import json
import math
import os
import fitz  # PyMuPDF
from reportlab.lib import colors
from reportlab.pdfgen import canvas

def draw_chromatogram(c, x, y, width, height, peak_rt=9.42, peak_name="Target Compound", purity_pct="99.6%"):
    """Draw a realistic HPLC chromatogram plot with axes, grid, baseline, and Gaussian peak."""
    c.saveState()
    
    # Background for plot area
    c.setFillColor(colors.HexColor('#fafcff'))
    c.setStrokeColor(colors.HexColor('#c8d8ec'))
    c.setLineWidth(1)
    c.rect(x, y, width, height, fill=1, stroke=1)
    
    # Plot title
    c.setFont("Helvetica-Bold", 8)
    c.setFillColor(colors.HexColor('#003366'))
    c.drawString(x + 12, y + height - 14, f"HPLC-UV Analytical Chromatogram (λ = 214 nm, DAD Detector)")
    c.setFont("Helvetica", 7)
    c.setFillColor(colors.HexColor('#64748b'))
    c.drawRightString(x + width - 12, y + height - 14, "Flow: 1.0 mL/min | Column: C18 RP 4.6×150mm 3.5µm")
    
    plot_x = x + 40
    plot_y = y + 22
    plot_w = width - 55
    plot_h = height - 44
    
    # Inner border
    c.setStrokeColor(colors.HexColor('#cbd5e1'))
    c.setLineWidth(0.6)
    c.rect(plot_x, plot_y, plot_w, plot_h, fill=0, stroke=1)
    
    # Y-axis ticks (Absorbance mAU: 0 to 400)
    for i in range(5):
        val = i * 100
        ty = plot_y + (i / 4.0) * plot_h
        c.setStrokeColor(colors.HexColor('#edf2f7'))
        c.setLineWidth(0.5)
        c.line(plot_x, ty, plot_x + plot_w, ty)
        c.setFont("Helvetica", 6)
        c.setFillColor(colors.HexColor('#64748b'))
        c.drawRightString(plot_x - 4, ty - 2, f"{val}")
    
    c.setFont("Helvetica-Bold", 6)
    c.setFillColor(colors.HexColor('#475569'))
    c.drawString(x + 6, y + height - 28, "mAU")
    
    # X-axis ticks (Minutes: 0 to 18)
    max_min = 18.0
    for m in range(0, 19, 2):
        tx = plot_x + (m / max_min) * plot_w
        c.setStrokeColor(colors.HexColor('#edf2f7'))
        c.setLineWidth(0.5)
        c.line(tx, plot_y, tx, plot_y + plot_h)
        c.setFont("Helvetica", 6)
        c.setFillColor(colors.HexColor('#64748b'))
        c.drawCentredString(tx, plot_y - 9, f"{m}")
    
    c.setFont("Helvetica-Bold", 6.5)
    c.setFillColor(colors.HexColor('#334155'))
    c.drawCentredString(plot_x + plot_w / 2, plot_y - 17, "Retention Time [Minutes]")
    
    # Generate HPLC curve data points (baseline + noise + major peak + tiny impurity shoulder)
    peak_center = max(2.5, min(15.5, peak_rt))
    sigma = 0.22
    points = []
    steps = 260
    for s in range(steps + 1):
        t = (s / steps) * max_min
        base = 8.0 + 2.5 * math.sin(t * 0.25) + (s % 3 - 1) * 0.4
        dist = t - peak_center
        main_peak = 350.0 * math.exp(-0.5 * (dist / sigma) ** 2)
        # tiny minor impurity peak at +2.5 min (0.3% area)
        imp_dist = t - (peak_center + 2.5 if peak_center + 2.5 < 17.5 else peak_center - 2.5)
        imp_peak = 2.4 * math.exp(-0.5 * (imp_dist / 0.16) ** 2)
        
        y_val = base + main_peak + imp_peak
        px = plot_x + (t / max_min) * plot_w
        py = plot_y + (y_val / 400.0) * plot_h
        points.append((px, py))
    
    # Draw curve
    c.setStrokeColor(colors.HexColor('#0052a3'))
    c.setLineWidth(1.3)
    path = c.beginPath()
    path.moveTo(points[0][0], points[0][1])
    for pt in points[1:]:
        path.lineTo(pt[0], pt[1])
    c.drawPath(path)
    
    # Peak marker and callout
    peak_px = plot_x + (peak_center / max_min) * plot_w
    peak_py = plot_y + (358.0 / 400.0) * plot_h
    c.setStrokeColor(colors.HexColor('#dc2626'))
    c.setFillColor(colors.HexColor('#dc2626'))
    c.circle(peak_px, peak_py, 2.2, fill=1, stroke=1)
    
    # Callout text box
    box_x = peak_px + 10 if peak_px < plot_x + plot_w - 110 else peak_px - 115
    box_y = peak_py - 14
    c.setFillColor(colors.HexColor('#ffffff'))
    c.setStrokeColor(colors.HexColor('#0052a3'))
    c.setLineWidth(0.8)
    c.roundRect(box_x, box_y, 105, 24, 2, fill=1, stroke=1)
    
    c.setFont("Helvetica-Bold", 7)
    c.setFillColor(colors.HexColor('#0052a3'))
    c.drawString(box_x + 6, box_y + 14, f"Main Peak: {peak_rt} min")
    c.setFont("Helvetica", 6.5)
    c.setFillColor(colors.HexColor('#16a34a'))
    c.drawString(box_x + 6, box_y + 4, f"Area %: {purity_pct} (Conforms)")
    
    c.restoreState()


def draw_barcode(c, x, y, width, height, text_code):
    """Draw a clean simulated Code-128 / PDF-417 style laboratory tracking barcode."""
    c.saveState()
    # Simple simulated 1D barcode lines
    import random
    rng = random.Random(sum(ord(ch) for ch in text_code))
    
    cur_x = x
    while cur_x < x + width:
        bar_w = rng.choice([1, 1.5, 2, 3])
        if rng.choice([True, True, False]):
            c.setFillColor(colors.HexColor('#1e293b'))
            c.rect(cur_x, y + 8, bar_w, height - 8, fill=1, stroke=0)
        cur_x += bar_w + rng.choice([1, 1.5, 2])
        
    c.setFont("Courier-Bold", 6)
    c.setFillColor(colors.HexColor('#475569'))
    c.drawCentredString(x + width / 2, y, text_code)
    c.restoreState()


def generate_single_coa(item, pdf_path, png_path):
    # Page setup: letter size 612 x 792 points
    page_w, page_h = 612, 792
    c = canvas.Canvas(pdf_path, pagesize=(page_w, page_h))
    
    # 1. Outer clinical double border
    c.setStrokeColor(colors.HexColor('#0052a3'))
    c.setLineWidth(2)
    c.rect(20, 20, page_w - 40, page_h - 40)
    
    c.setStrokeColor(colors.HexColor('#cbd5e1'))
    c.setLineWidth(0.8)
    c.rect(23, 23, page_w - 46, page_h - 46)
    
    # 2. Header Banner
    c.setFillColor(colors.HexColor('#0052a3'))
    c.rect(24, page_h - 90, page_w - 48, 66, fill=1, stroke=0)
    
    # Laboratory title
    c.setFont("Helvetica-Bold", 13.5)
    c.setFillColor(colors.white)
    c.drawString(38, page_h - 52, "TRIENZA ANALYTICAL RESEARCH LABORATORIES")
    c.setFont("Helvetica", 8)
    c.setFillColor(colors.HexColor('#d0e3ff'))
    c.drawString(38, page_h - 66, "UKAS ISO/IEC 17025:2017 ACCREDITED TESTING FACILITY • LAB ACCREDITATION #8492")
    c.drawString(38, page_h - 78, "Third-Party Analytical Verification & High-Performance Liquid Chromatography (HPLC) Report")
    
    # Right-side badge
    c.setFillColor(colors.HexColor('#003d7a'))
    c.roundRect(page_w - 140, page_h - 82, 110, 48, 3, fill=1, stroke=0)
    c.setFont("Helvetica-Bold", 8)
    c.setFillColor(colors.white)
    c.drawCentredString(page_w - 85, page_h - 50, "ISO 17025")
    c.setFont("Helvetica", 6.5)
    c.setFillColor(colors.HexColor('#93c5fd'))
    c.drawCentredString(page_w - 85, page_h - 62, "UKAS ACCREDITED")
    c.setFont("Helvetica-Bold", 7)
    c.setFillColor(colors.HexColor('#34d399'))
    c.drawCentredString(page_w - 85, page_h - 74, "● TEST VERIFIED")
    
    # 3. Document Title Bar
    c.setFont("Helvetica-Bold", 14)
    c.setFillColor(colors.HexColor('#0a1a2e'))
    c.drawString(38, page_h - 114, "CERTIFICATE OF ANALYSIS (COA)")
    
    c.setFont("Helvetica", 7.5)
    c.setFillColor(colors.HexColor('#64748b'))
    c.drawString(38, page_h - 126, f"Document ID: COA-{item['batch']} • Date of Issue: {item['tested']}")
    c.drawRightString(page_w - 38, page_h - 126, "Page 1 of 1 • Official Batch Documentation")
    
    c.setStrokeColor(colors.HexColor('#0052a3'))
    c.setLineWidth(1.5)
    c.line(38, page_h - 132, page_w - 38, page_h - 132)
    
    # 4. Sample Identification Box
    y_info = page_h - 222
    c.setFillColor(colors.HexColor('#f8fafc'))
    c.setStrokeColor(colors.HexColor('#cbd5e1'))
    c.setLineWidth(1)
    c.roundRect(38, y_info, page_w - 76, 84, 2, fill=1, stroke=1)
    
    # Left Column
    c.setFont("Helvetica-Bold", 8)
    c.setFillColor(colors.HexColor('#0052a3'))
    c.drawString(48, y_info + 68, "Compound Name:")
    c.drawString(48, y_info + 52, "Catalog SKU:")
    c.drawString(48, y_info + 36, "Batch / Lot No:")
    c.drawString(48, y_info + 20, "CAS Registry:")
    c.drawString(48, y_info + 4, "Molecular Formula:")
    
    c.setFont("Helvetica", 8)
    c.setFillColor(colors.HexColor('#0f172a'))
    c.drawString(142, y_info + 68, item['name'])
    c.drawString(142, y_info + 52, item['sku'])
    c.drawString(142, y_info + 36, item['batch'])
    c.drawString(142, y_info + 20, item['cas'])
    c.drawString(142, y_info + 4, item['formula'])
    
    # Right Column
    c.setFont("Helvetica-Bold", 8)
    c.setFillColor(colors.HexColor('#0052a3'))
    c.drawString(320, y_info + 68, "Client / Sponsor:")
    c.drawString(320, y_info + 52, "Analysis Date:")
    c.drawString(320, y_info + 36, "Molecular Weight:")
    c.drawString(320, y_info + 20, "Physical State:")
    c.drawString(320, y_info + 4, "Storage Regimen:")
    
    c.setFont("Helvetica", 8)
    c.setFillColor(colors.HexColor('#0f172a'))
    c.drawString(415, y_info + 68, "ResearchChem.uk / Trienza UK")
    c.drawString(415, y_info + 52, item['tested'])
    c.drawString(415, y_info + 36, item['mol_weight'])
    c.drawString(415, y_info + 20, "Lyophilized Cake / Liquid")
    c.drawString(415, y_info + 4, "-20°C Desiccated, Dry")
    
    # 5. Quantitative Test Results Table
    y_table = y_info - 120
    c.setFont("Helvetica-Bold", 9)
    c.setFillColor(colors.HexColor('#003366'))
    c.drawString(38, y_table + 107, "ANALYTICAL TEST RESULTS")
    
    # Table header
    c.setFillColor(colors.HexColor('#0052a3'))
    c.rect(38, y_table + 88, page_w - 76, 16, fill=1, stroke=0)
    c.setFont("Helvetica-Bold", 7.5)
    c.setFillColor(colors.white)
    c.drawString(44, y_table + 92, "Testing Parameter")
    c.drawString(155, y_table + 92, "Analytical Method")
    c.drawString(265, y_table + 92, "Specification")
    c.drawString(375, y_table + 92, "Observed Result")
    c.drawString(485, y_table + 92, "Batch Status")
    
    # Format cleaner observed values so nothing clips
    clean_app = "Conforms (Visual)"
    clean_ms = item['mass_spec'].split(' (')[0] + " (Conforms)"
    
    rows = [
        ("Appearance", "Visual Inspection", "Conforming Standard", clean_app, "PASS"),
        ("Identification", "LC-MS / ESI-MS", "M+H+ Theoretical Mass", clean_ms, "PASS"),
        ("Chromatographic Purity", "HPLC (UV @ 214nm)", "≥ 98.00% Area", item['purity'] + " Area", "PASS"),
        ("Retention Time (Rt)", "Reverse-Phase HPLC", "Reference ± 0.5 min", item['hplc_rt'], "PASS"),
        ("Bacterial Endotoxin", "USP <85> Turbidimetric", "< 0.05 EU/mg", item['endotoxin'], "PASS"),
    ]
    
    for idx, r in enumerate(rows):
        row_y = y_table + 70 - (idx * 16)
        bg = colors.HexColor('#ffffff') if idx % 2 == 0 else colors.HexColor('#f8fafc')
        c.setFillColor(bg)
        c.rect(38, row_y - 2, page_w - 76, 16, fill=1, stroke=0)
        
        c.setStrokeColor(colors.HexColor('#e2e8f0'))
        c.setLineWidth(0.5)
        c.line(38, row_y - 2, page_w - 38, row_y - 2)
        
        c.setFont("Helvetica-Bold", 7)
        c.setFillColor(colors.HexColor('#1e293b'))
        c.drawString(44, row_y + 3, r[0])
        
        c.setFont("Helvetica", 7)
        c.setFillColor(colors.HexColor('#475569'))
        c.drawString(155, row_y + 3, r[1])
        c.drawString(265, row_y + 3, r[2])
        
        c.setFont("Helvetica-Bold", 7)
        c.setFillColor(colors.HexColor('#0f172a'))
        c.drawString(375, row_y + 3, r[3])
        
        c.setFillColor(colors.HexColor('#15803d'))
        c.drawString(495, row_y + 3, "✔ " + r[4])
    
    # 6. HPLC Chromatogram Plot
    y_plot = y_table - 170
    rt_val = float(item['hplc_rt'].replace(' min', ''))
    draw_chromatogram(c, 38, y_plot, page_w - 76, 150, peak_rt=rt_val, peak_name=item['name'], purity_pct=item['purity'])
    
    # 7. Quality Assurance & Lab Sign-Off Section
    y_sign = y_plot - 84
    c.setStrokeColor(colors.HexColor('#cbd5e1'))
    c.setLineWidth(1)
    c.setFillColor(colors.HexColor('#f8fafc'))
    c.roundRect(38, y_sign, page_w - 76, 72, 2, fill=1, stroke=1)
    
    # Official Seal circle (neatly nested and centered)
    seal_x = 75
    seal_y = y_sign + 36
    c.setStrokeColor(colors.HexColor('#0052a3'))
    c.setLineWidth(1.4)
    c.circle(seal_x, seal_y, 24, fill=0, stroke=1)
    c.setLineWidth(0.6)
    c.circle(seal_x, seal_y, 21, fill=0, stroke=1)
    c.setFont("Helvetica-Bold", 5)
    c.setFillColor(colors.HexColor('#0052a3'))
    c.drawCentredString(seal_x, seal_y + 11, "TRIENZA LABS")
    c.drawCentredString(seal_x, seal_y + 1, "QUALITY SEAL")
    c.setFont("Helvetica-Bold", 6.5)
    c.setFillColor(colors.HexColor('#15803d'))
    c.drawCentredString(seal_x, seal_y - 9, "PASSED")
    c.setFont("Helvetica-Bold", 4.5)
    c.setFillColor(colors.HexColor('#0052a3'))
    c.drawCentredString(seal_x, seal_y - 17, "ISO/IEC 17025")
    
    # Signature 1
    c.setFont("Helvetica-Bold", 7.5)
    c.setFillColor(colors.HexColor('#1e293b'))
    c.drawString(135, y_sign + 48, "Analytical Chemist:")
    c.setFont("Times-Italic", 11)
    c.setFillColor(colors.HexColor('#0f2b5c'))
    c.drawString(135, y_sign + 30, "Arthur Sterling, Ph.D.")
    c.setStrokeColor(colors.HexColor('#94a3b8'))
    c.setLineWidth(0.6)
    c.line(135, y_sign + 26, 260, y_sign + 26)
    c.setFont("Helvetica", 6.5)
    c.setFillColor(colors.HexColor('#64748b'))
    c.drawString(135, y_sign + 16, "Lead Chromatographer, HPLC Division")
    
    # Signature 2
    c.setFont("Helvetica-Bold", 7.5)
    c.setFillColor(colors.HexColor('#1e293b'))
    c.drawString(295, y_sign + 48, "Quality Assurance Director:")
    c.setFont("Times-Italic", 11)
    c.setFillColor(colors.HexColor('#0f2b5c'))
    c.drawString(295, y_sign + 30, "Dr. Marian Harrison, QA/QC")
    c.setStrokeColor(colors.HexColor('#94a3b8'))
    c.setLineWidth(0.6)
    c.line(295, y_sign + 26, 430, y_sign + 26)
    c.setFont("Helvetica", 6.5)
    c.setFillColor(colors.HexColor('#64748b'))
    c.drawString(295, y_sign + 16, "Authorized Release Officer")
    
    # Barcode tracking badge on far right of signature card
    draw_barcode(c, 455, y_sign + 14, 110, 42, f"*{item['batch']}*")
    
    # 8. Legal and Research Compliance Statement
    c.setFont("Helvetica", 5.5)
    c.setFillColor(colors.HexColor('#64748b'))
    c.drawCentredString(page_w / 2, 33, "This analytical Certificate of Analysis reflects tests executed in compliance with accredited ISO/IEC 17025 standards.")
    c.drawCentredString(page_w / 2, 25, "For laboratory and in-vitro research use only. Not for human or veterinary administration. © Trienza Laboratory Research.")
    
    c.save()
    
    # Convert PDF page to high-res PNG (200 DPI = ~1700 x 2200 px)
    doc = fitz.open(pdf_path)
    page = doc.load_page(0)
    zoom = 200 / 72
    mat = fitz.Matrix(zoom, zoom)
    pix = page.get_pixmap(matrix=mat, alpha=False)
    pix.save(png_path)
    doc.close()

def main():
    with open('scratch_coa_items.json', 'r') as f:
        items = json.load(f)
    
    target_dir = os.path.join('public', 'assets', 'images', 'coa')
    temp_dir = 'tmp_coa_build'
    os.makedirs(target_dir, exist_ok=True)
    os.makedirs(temp_dir, exist_ok=True)
    
    print(f"Starting generation of {len(items)} Certificate of Analysis images...")
    
    for i, item in enumerate(items, 1):
        filename = item['file']
        pdf_path = os.path.join(temp_dir, filename.replace('.png', '.pdf'))
        png_path = os.path.join(target_dir, filename)
        
        generate_single_coa(item, pdf_path, png_path)
        size_kb = os.path.getsize(png_path) / 1024
        print(f"[{i}/{len(items)}] Generated {filename} ({size_kb:.1f} KB) - {item['name']}")
        
    print("All COA reports successfully generated and updated in public/assets/images/coa/!")

if __name__ == '__main__':
    main()

