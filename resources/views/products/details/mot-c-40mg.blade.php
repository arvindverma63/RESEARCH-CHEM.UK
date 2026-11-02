            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C (frequently identified in scientific literature as MOTS-c) is a synthetic mitochondrial-derived peptide composed of 16 amino acids. It originates from research into short open reading frames within the mitochondrial 12S ribosomal RNA gene and has been investigated in experimental studies examining cellular bioenergetics, metabolic signalling, insulin sensitivity, and adaptive cellular stress responses.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">MOT-C has attracted widespread scientific interest due to research demonstrating its role as an exercise-mimetic mitochondrial signalling hormone that translocates into the nucleus to coordinate adaptive metabolic gene expression. Research-Chem.uk supplies MOT-C as a laboratory research compound intended strictly for in-vitro, analytical, and scientific research applications.</p>
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
    ['Product', 'MOT-C'],
    ['Vial', '3ml'],
    ['Peptide Content', '40mg'],
    ['Purity', '98.0%'],
    ['Testing', 'HPLC verified'],
    ['Documentation', 'Batch-specific Certificate of Analysis (COA)'],
    ['Application', 'Laboratory research only'],
    ['Dispatch', 'UK'],
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
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C is a bioactive 16-amino-acid peptide encoded within the mitochondrial genome. Its verified primary sequence is:</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3 font-mono bg-card border border-border px-3 py-2 rounded">Met-Arg-Trp-Gln-Glu-Met-Gly-Tyr-Ile-Phe-Tyr-Pro-Arg-Lys-Leu-Arg (MRWQEMGYIFYPRKLR)</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The peptide is closely associated with research into mitochondrial-derived peptides (MDPs), an emerging class of signalling molecules that facilitate retrograde communication between mitochondria and the nuclear genome.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Discovered through transcriptomic analysis of mitochondrial small open reading frames, MOT-C translocates to the nucleus under metabolic stress and regulates nuclear gene expression involved in cellular energy metabolism, glycolysis, and fatty acid oxidation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The scientific interest surrounding MOT-C centres primarily on its ability to stimulate cellular metabolic pathways independently of classical cell-surface receptor activation, providing a distinctive molecular tool for bioenergetics research.</p>
              </section>

              <!--  How Is MOT-C Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is MOT-C Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C has been studied using a combination of cellular, biochemical, and animal research models. Experimental investigations have examined:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>AMP-activated protein kinase (AMPK) phosphorylation and signalling kinetics</li>
                  <li>Inhibition of the folate-methionine cycle and AICAR accumulation</li>
                  <li>Cellular glucose uptake and insulin-independent GLUT4 translocation</li>
                  <li>Skeletal muscle insulin sensitivity and metabolic flexibility</li>
                  <li>Mitochondrial respiration, oxygen consumption rate (OCR), and ATP production</li>
                  <li>Fatty acid β-oxidation and intracellular lipid droplet clearance</li>
                  <li>Mitochondrial-nuclear communication and chromatin association</li>
                  <li>Cellular senescence, proteostasis, and longevity-associated markers</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">One of the primary mechanisms elucidated in vitro is the inhibition of the folate cycle, which leads to intracellular accumulation of AICAR and subsequent activation of the metabolic master switch AMPK.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">This mechanism reproduces several biochemical hallmarks of exercise and caloric restriction, making MOT-C an important compound for experimental metabolic research.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">MOT-C Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Bioenergetics &amp; AMPK Signalling</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">AMPK is the master sensor of intracellular energy status. Experimental exposure to MOT-C has been shown to induce rapid AMPK phosphorylation without disturbing ATP:ADP ratios, making the peptide relevant to laboratory investigations examining:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>AMPK catalytic subunit activation</li>
                      <li>Acetyl-CoA carboxylase (ACC) phosphorylation</li>
                      <li>PGC-1α transcriptional co-activation</li>
                      <li>Mitochondrial biogenesis and respiration kinetics</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Glucose Metabolism &amp; Insulin Sensitivity</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">MOT-C has been investigated as an experimental model for examining insulin-independent glucose handling. Research models evaluate changes in:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>GLUT4 vesicle translocation in skeletal myoblasts</li>
                      <li>Insulin-stimulated glucose disposal under lipid-overload conditions</li>
                      <li>Suppression of hepatic gluconeogenic enzyme transcription</li>
                      <li>Glycogen synthesis rates in vitro</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Lipid Catabolism &amp; β-Oxidation</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Experimental studies involving MOT-C evaluate fatty acid clearance and carnitine palmitoyltransferase-1 (CPT-1) activity. This provides a scientific framework for examining the relationship between mitochondrial signalling and lipid homeostasis.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Ageing &amp; Healthspan Models</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Circulating MOT-C levels decline with age in mammalian models. Pre-clinical research has explored whether exogenous MOT-C administration influences age-related metabolic dysregulation, physical performance markers, and mitochondrial membrane structural integrity.</p>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C represents a major paradigm shift in mitochondrial biology, establishing that mitochondria encode hormonal peptides capable of systemic metabolic regulation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Initial research published in <em>Cell Metabolism</em> (Lee et al., 2015) identified MOTS-c as a functional metabolic regulator that prevented high-fat-diet-induced insulin resistance and obesity in animal models.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Subsequent investigations demonstrated that MOT-C enters the nucleus during metabolic stress and binds chromatin, interacting with antioxidant response elements and transcription factors to modulate adaptive gene networks.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">It is essential to distinguish between laboratory research findings and human clinical validation. For controlled experimental research, MOT-C provides an exceptional defined peptide model for investigating mitochondrial-nuclear communication and metabolic resilience.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>Lee C, et al. <em>The Mitochondrial-Derived Peptide MOTS-c Promotes Metabolic Homeostasis and Reduces Obesity and Insulin Resistance.</em> Cell Metab. 2015;21(3):443-454.</li>
                  <li>Kim KH, et al. <em>The Mitochondrial-Encoded Peptide MOTS-c Translocates to the Nucleus to Regulate Nuclear Gene Expression in Response to Metabolic Stress.</em> Cell Metab. 2018;28(3):516-524.</li>
                  <li>Reynolds JC, et al. <em>MOTS-c is an exercise-induced mitochondrial-encoded regulator of physical capacity and performance.</em> Nat Commun. 2021;12(1):470.</li>
                  <li>Cobb LJ, et al. <em>Naturally occurring mitochondrial-derived peptides are age-dependent regulators of cellular and systemic metabolism.</em> PNAS. 2016;113(8):2100-2105.</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Researchers should consult the original peer-reviewed publications when evaluating experimental design, concentration ranges, and reconstitution protocols.</p>
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
$tableRows = [
    ['Product Name', 'MOT-C'],
    ['Alternative Names', 'MOTS-c / Mitochondrial-Derived Peptide'],
    ['Vial Size', '3ml'],
    ['Peptide Content', '40mg'],
    ['Purity', '98.0%'],
    ['Peptide Sequence', 'Met-Arg-Trp-Gln-Glu-Met-Gly-Tyr-Ile-Phe-Tyr-Pro-Arg-Lys-Leu-Arg (MRWQEMGYIFYPRKLR)'],
    ['Testing Method', 'HPLC'],
    ['Physical Form', 'Lyophilised peptide'],
    ['Intended Application', 'Laboratory research only'],
    ['Documentation', 'Batch-specific COA'],
];
@endphp
@foreach($tableRows as $i => $row)
<tr class="{{ $i % 2 === 1 ? 'bg-card' : '' }}">
                          <td class="p-3 border border-border text-muted-foreground font-medium">{{ $row[0] }}</td>
                          <td class="p-3 border border-border text-muted-foreground">{{ $row[1] }}</td>
                        </tr>
@endforeach
                    </tbody>
                  </table>
                </div>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">MOT-C is a synthetic 16-amino-acid peptide derived from the mitochondrial 12S rRNA open reading frame.</p>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research peptide range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">This MOT-C batch is supplied with a stated 98.0% purity, with HPLC analysis used to assess peptide purity. Each batch is supported by a Certificate of Analysis (COA) providing analytical documentation for the supplied material.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Our quality-control approach is designed to give researchers clearly documented materials for controlled laboratory investigations and analytical research. Researchers should always refer to the relevant batch-specific COA when recording analytical characteristics for experimental work.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">MOT-C may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>AMPK signalling and phosphorylation kinetics</li>
                  <li>Mitochondrial retrograde signalling pathways</li>
                  <li>Cellular glucose uptake and GLUT4 translocation</li>
                  <li>Skeletal muscle insulin sensitivity models</li>
                  <li>Fatty acid β-oxidation and lipid clearance</li>
                  <li>Cellular senescence and longevity research</li>
                  <li>Mitochondrial biogenesis and ATP synthesis</li>
                  <li>Peptide biochemistry and analytical chromatography</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">MOT-C is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
              </section>

              <!--  Why Choose Research-Chem.uk?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research-Chem.uk provides research peptides for laboratories, analytical researchers and other qualified research environments. Our peptide range focuses on:</p>
                <div class="flex flex-col gap-4">
                  @php
$whyChooseItems = [
    ['HPLC-Verified Purity', 'Peptide products are subjected to analytical purity assessment, with batch-specific documentation available.'],
    ['Batch Traceability', 'Products are supplied with Certificate of Analysis documentation to support laboratory record keeping and material identification.'],
    ['UK Dispatch', 'Research compounds are dispatched from the UK for efficient domestic delivery.'],
    ['Research-Only Positioning', 'Our products are supplied exclusively for legitimate laboratory research and analytical applications.'],
    ['Clear Product Specifications', 'Each product page provides defined peptide content, purity information and relevant scientific context where available.'],
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
                  <p>For laboratory research use only. Not for human or veterinary use.</p>
                  <p>MOT-C supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>The scientific information presented on this page summarises experimental research concerning MOT-C and related mitochondrial-derived peptides. Experimental findings should not be interpreted as recommendations for human use or as evidence that MOT-C is an established medical treatment.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>
