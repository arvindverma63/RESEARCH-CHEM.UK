            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C (frequently catalogued in scientific literature as MOTS-c) is a 16-amino-acid mitochondrial-derived peptide (MDP) encoded within the mitochondrial 12S ribosomal RNA gene.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Unlike conventional nuclear-encoded peptide hormones, MOT-C represents an evolutionary class of bioactive mitochondrial signalling molecules that translocate to the nucleus and coordinate adaptive metabolic and cellular stress responses.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Laboratory investigations involving MOT-C focus on cellular bioenergetics, AMP-activated protein kinase (AMPK) activation, fatty acid oxidation, insulin-sensitising pathways, and metabolic regulation. Research-Chem.uk supplies MOT-C 40mg as an analytical-grade laboratory research compound intended strictly for in-vitro, cell culture, and scientific research applications.</p>
                <div class="overflow-x-auto">
                  <table class="w-full text-sm border-collapse">
                    <thead>
                      <tr class="bg-card">
                        <th class="text-left p-3 border border-border font-semibold text-primary" colspan="2">Key Product Features</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
$tableRows = [
    ['Product', 'MOT-C (MOTS-c)'],
    ['Vial Quantity', '40mg'],
    ['Purity Threshold', '≥98.0% (HPLC verified)'],
    ['Molecular Formula', 'C₁₀₁H₁₅₂N₂₈O₂₂S'],
    ['Molecular Weight', '2174.6 g/mol'],
    ['CAS Number', '1627580-64-6'],
    ['Physical Form', 'Lyophilised white powder'],
    ['Documentation', 'Batch-specific Certificate of Analysis (COA)'],
    ['Intended Application', 'In-vitro scientific laboratory research only'],
    ['Origin / Dispatch', 'United Kingdom (Dispatched in 2–3 working days)'],
];
@endphp
@foreach($tableRows as $i => $row)
<tr class="{{ $i % 2 === 1 ? 'bg-card' : '' }}">
                          <td class="p-3 border border-border text-muted-foreground font-medium w-1/3">{{ $row[0] }}</td>
                          <td class="p-3 border border-border text-muted-foreground">{{ $row[1] }}</td>
                        </tr>
@endforeach
                    </tbody>
                  </table>
                </div>
              </section>

              <!--  What Is MOT-C?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is MOT-C?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C is a bioactive 16-amino-acid peptide encoded within the short open reading frame of mitochondrial DNA. Its verified primary sequence is:</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3 font-mono bg-card border border-border px-3 py-2 rounded">Met-Arg-Trp-Gln-Glu-Met-Gly-Tyr-Ile-Phe-Tyr-Pro-Arg-Lys-Leu-Arg (MRWQEMGYIFYPRKLR)</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Discovered through transcriptomic and ribo-seq profiling of mitochondrial small open reading frames, MOT-C serves as a hormonal signal facilitating retrograde communication from mitochondria to the nucleus.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">In response to cellular metabolic stress, MOT-C translocates into the nucleus and associates with chromatin, binding specific transcription factor complexes to modulate target gene expression governing glycolysis and lipid catabolism.</p>
              </section>

              <!--  How Is MOT-C Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is MOT-C Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C is studied across biochemical assays, cell culture lines, and animal models. Key experimental pathways examined in published literature include:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>AMP-activated protein kinase (AMPK) phosphorylation and downstream signalling</li>
                  <li>Inhibition of the folate-methionine cycle and AICAR accumulation</li>
                  <li>Cellular glucose uptake and GLUT4 translocation mechanisms</li>
                  <li>Skeletal muscle insulin sensitivity and metabolic flexibility</li>
                  <li>Mitochondrial biogenesis, oxygen consumption rate (OCR), and ATP synthesis</li>
                  <li>Fatty acid β-oxidation and intracellular lipid droplet accumulation</li>
                  <li>Mitochondrial retrograde signalling and nuclear translocation dynamics</li>
                  <li>Cellular senescence, proteostasis, and longevity-associated biological markers</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">One of MOT-C's primary established molecular mechanisms in vitro is the inhibition of the folate cycle, which leads to the accumulation of 5-aminoimidazole-4-carboxamide ribonucleotide (AICAR) and the subsequent activation of the AMPK metabolic master regulator.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">This mechanism mimics the cellular response to nutrient deprivation or endurance exercise, making MOT-C an invaluable tool for exploring energy metabolism and metabolic homeostasis in experimental biology.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">MOT-C Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Energy &amp; AMPK Signalling Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">AMPK is the central metabolic sensor of eukaryotic cells. Experimental exposure to MOT-C has been shown to induce rapid AMPK phosphorylation without altering intracellular AMP:ATP ratios. Laboratory research utilizes MOT-C to investigate:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>AMPK α-subunit activation kinetics</li>
                      <li>Acetyl-CoA carboxylase (ACC) phosphorylation</li>
                      <li>PGC-1α upregulation and mitochondrial DNA transcription</li>
                      <li>Targeted cellular energy expenditure pathways</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Glucose Metabolism &amp; Insulin Sensitivity Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Experimental cell culture models investigating insulin-independent glucose uptake frequently examine MOT-C. Published research highlights its capacity to stimulate:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>GLUT4 vesicle translocation in skeletal myoblasts</li>
                      <li>Glucose transporter expression under insulin-resistant conditions</li>
                      <li>Hepatic gluconeogenic enzyme downregulation</li>
                      <li>Glycogen synthesis and glycolytic rate alterations</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Lipid Metabolism &amp; β-Oxidation Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">In vitro adipocyte and myocyte assays evaluate MOT-C's impact on fatty acid clearance and lipid peroxidation. Studies report enhanced fatty acid oxidation, reduced ectopic lipid accumulation, and alterations in carnitine palmitoyltransferase-1 (CPT-1) activity.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Mitochondrial Biology &amp; Ageing Models</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Because endogenous MOT-C circulating levels decline with age in mammalian models, researchers investigate its role in counteracting cellular senescence, preserving mitochondrial cristae morphology, and supporting stem cell viability under oxidative stress.</p>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Seminal research published in <em>Cell Metabolism</em> (Lee et al., 2015) first established MOTS-c as a functional hormonal peptide encoded in the mitochondrial genome that prevents high-fat-diet-induced insulin resistance and obesity in animal models.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Subsequent studies demonstrated that MOT-C enters the cell nucleus during exercise or nutrient stress, interacting with heat shock transcription factor 1 (HSF1) and antioxidant response elements to modulate nuclear gene networks.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Research published in <em>Nature Communications</em> (2021) further established that MOTS-c treatment in mice enhanced physical performance, healthspan, and neuromuscular coordination even when administered in advanced age.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">These laboratory findings position MOT-C as a cornerstone compound for investigating mitochondrial-nuclear cross-talk and metabolic resilience in pre-clinical research models.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Key Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>Lee C, et al. <em>The Mitochondrial-Derived Peptide MOTS-c Promotes Metabolic Homeostasis and Reduces Obesity and Insulin Resistance.</em> Cell Metab. 2015;21(3):443-454.</li>
                  <li>Kim KH, et al. <em>The Mitochondrial-Encoded Peptide MOTS-c Translocates to the Nucleus to Regulate Nuclear Gene Expression in Response to Metabolic Stress.</em> Cell Metab. 2018;28(3):516-524.</li>
                  <li>Reynolds JC, et al. <em>MOTS-c is an exercise-induced mitochondrial-encoded regulator of physical capacity and performance.</em> Nat Commun. 2021;12(1):470.</li>
                  <li>Cobb LJ, et al. <em>Naturally occurring mitochondrial-derived peptides are age-dependent regulators of cellular and systemic metabolism.</em> PNAS. 2016;113(8):2100-2105.</li>
                </ul>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">MOT-C Product Specifications</h2>
                <div class="overflow-x-auto">
                  <table class="w-full text-sm border-collapse">
                    <thead>
                      <tr class="bg-card">
                        <th class="text-left p-3 border border-border font-semibold text-primary">Specification</th>
                        <th class="text-left p-3 border border-border font-semibold text-primary">Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
$specRows = [
    ['Product Name', 'MOT-C 40MG'],
    ['Alternative Names', 'MOTS-c / Mitochondrial Open Reading Frame of the 12S rRNA Type-c'],
    ['CAS Number', '1627580-64-6'],
    ['Molecular Formula', 'C₁₀₁H₁₅₂N₂₈O₂₂S'],
    ['Molecular Weight', '2174.6 g/mol'],
    ['Primary Sequence', 'Met-Arg-Trp-Gln-Glu-Met-Gly-Tyr-Ile-Phe-Tyr-Pro-Arg-Lys-Leu-Arg'],
    ['Single-Letter Sequence', 'MRWQEMGYIFYPRKLR'],
    ['Peptide Content', '40mg active compound per vial'],
    ['Purity Threshold', '≥98.0% (Assessed via High-Performance Liquid Chromatography)'],
    ['Physical State', 'Lyophilised white solid / powder'],
    ['Solubility', 'Soluble in sterile bacteriostatic water / aqueous research buffers'],
    ['Storage Recommendation', '−20 °C long-term dry storage; 2–8 °C reconstituted short-term'],
    ['Documentation', 'Batch-specific analytical Certificate of Analysis (COA)'],
    ['Legal Classification', 'Chemical compound strictly intended for in-vitro laboratory research only'],
];
@endphp
@foreach($specRows as $i => $row)
<tr class="{{ $i % 2 === 1 ? 'bg-card' : '' }}">
                          <td class="p-3 border border-border text-muted-foreground font-medium w-1/3">{{ $row[0] }}</td>
                          <td class="p-3 border border-border text-muted-foreground">{{ $row[1] }}</td>
                        </tr>
@endforeach
                    </tbody>
                  </table>
                </div>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Analytical Assurance</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical purity and chemical fidelity are paramount for all compounds in our research catalog.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Every batch of MOT-C is verified via High-Performance Liquid Chromatography (HPLC) and Mass Spectrometry (MS) to validate its primary amino acid sequence and confirm a minimum purity threshold of 98.0%.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Each vial is supplied with batch-specific analytical documentation ensuring complete traceability for academic institutions, commercial laboratories, and independent research scientists.</p>
              </section>

              <!--  Why Choose Research-Chem.uk?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
                <div class="flex flex-col gap-4">
                  @php
$whyChooseItems = [
    ['HPLC-Verified High Purity', 'Every batch is subject to rigorous analytical chromatography to confirm identity and ≥98% purity.'],
    ['Batch Traceability & COA', 'Comprehensive Certificate of Analysis available for every batch to support accurate laboratory records.'],
    ['Express Domestic UK Dispatch', 'Dispatched securely from the UK in protective packaging within 2–3 working days.'],
    ['Specialist Laboratory Focus', 'Supplied exclusively to qualified researchers for legitimate in-vitro scientific investigations.'],
    ['Exact Content Integrity', 'Accurate 40mg volumetric fill per vial, ensuring consistent experimental reconstitution.'],
];
@endphp
@foreach($whyChooseItems as $i => $item)
<div>
                      <p class="text-sm font-semibold text-primary mb-1">{{ $item[0] }}</p>
                      <p class="text-sm text-muted-foreground leading-relaxed">{{ $item[1] }}</p>
                    </div>
@endforeach
                </div>
              </section>

              <!--  Research-Use Disclaimer  -->
              <div class="flex items-start gap-3 p-4 border border-border text-sm" style="background-color: #fff8e1">
                <i data-lucide="flask-conical" class="w-5 h-5 shrink-0 mt-0.5 text-accent"></i>
                <div class="flex flex-col gap-2 text-muted-foreground">
                  <p><strong class="text-accent">Research-Use Disclaimer</strong></p>
                  <p><strong>For in-vitro laboratory research and analytical testing only. Not for human or veterinary use.</strong></p>
                  <p>MOT-C (MOTS-c) supplied by Research-Chem.uk is intended exclusively for controlled scientific investigation by qualified research professionals.</p>
                  <p>This compound is not a pharmaceutical product, medicine, food additive, or dietary supplement. It must not be introduced into humans or animals under any circumstances. All handling must follow standard institutional safety guidelines and applicable UK regulations.</p>
                </div>
              </div>

            </div>
