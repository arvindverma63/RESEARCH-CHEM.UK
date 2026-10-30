            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Tirzepatide is a synthetic peptide-based compound that acts as a dual agonist of the glucose-dependent insulinotropic polypeptide (GIP) receptor and glucagon-like peptide-1 (GLP-1) receptor.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Tirzepatide has been extensively investigated in metabolic and endocrine research, particularly in relation to glucose regulation, insulin secretion, energy metabolism and body-weight regulation. Its dual GIP/GLP-1 receptor activity makes it an important research compound for studying interactions between incretin signalling and metabolic pathways. Research-Chem.uk supplies Tirzepatide as a laboratory research compound intended strictly for in-vitro, analytical and scientific research applications.</p>
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
['Product', 'Tirzepatide'],
                        ['Vial', '3ml'],
                        ['Peptide Content', '10mg'],
                        ['Purity', '98.9%'],
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

              <!--  What Is Tirzepatide?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is Tirzepatide?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Tirzepatide is a synthetic peptide-based molecule designed to interact with two incretin hormone receptors: GIPR and GLP-1R.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GIP and GLP-1 are endogenous metabolic hormones involved in glucose-dependent insulin secretion and broader metabolic signalling. Tirzepatide was developed with structural modifications that provide prolonged biological activity compared with the naturally occurring hormones.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The molecule contains a modified peptide backbone and a fatty-acid-derived moiety that contributes to its interaction with albumin and extended circulation time.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">From a research perspective, Tirzepatide provides a model for investigating dual incretin-receptor activation and the resulting effects on pancreatic, hepatic and metabolic signalling pathways.</p>
              </section>

              <!--  How Is Tirzepatide Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is Tirzepatide Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Tirzepatide has been investigated extensively in both preclinical and clinical research. Experimental research has examined:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>GIP receptor activation</li>
                  <li>GLP-1 receptor activation</li>
                  <li>Insulin secretion</li>
                  <li>Glucagon regulation</li>
                  <li>Glucose-dependent signalling</li>
                  <li>Pancreatic beta-cell function</li>
                  <li>Energy metabolism</li>
                  <li>Food-intake regulation</li>
                  <li>Body-weight regulation</li>
                  <li>Lipid metabolism</li>
                  <li>Insulin sensitivity</li>
                  <li>Cardiometabolic pathways</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">A major scientific interest in Tirzepatide is its dual receptor activity. Rather than selectively activating only the GLP-1 receptor, Tirzepatide activates both GIP and GLP-1 receptors. This provides researchers with an opportunity to investigate how simultaneous incretin signalling differs from activation of either pathway independently.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Tirzepatide Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Incretin-Receptor Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Tirzepatide is particularly relevant to studies investigating the interaction between GIP and GLP-1 receptor pathways. Researchers can examine receptor activation, intracellular signalling and downstream metabolic responses using cellular and biochemical models.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Glucose Metabolism Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">GIP and GLP-1 signalling are closely associated with glucose-dependent insulin secretion. Tirzepatide has therefore been investigated in experimental models examining:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Glucose homeostasis</li>
                      <li>Insulin secretion</li>
                      <li>Glucagon signalling</li>
                      <li>Pancreatic beta-cell activity</li>
                      <li>Insulin sensitivity</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Metabolic Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Tirzepatide has become an important research tool for studying broader metabolic processes. Research has examined effects associated with:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Energy expenditure</li>
                      <li>Nutrient metabolism</li>
                      <li>Lipid metabolism</li>
                      <li>Adipose-tissue biology</li>
                      <li>Insulin resistance</li>
                      <li>Body-weight regulation</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Appetite and Energy-Balance Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Central and peripheral incretin signalling contributes to the regulation of food intake and energy balance. Experimental research involving Tirzepatide has therefore examined pathways connecting GIP/GLP-1 receptor activation with appetite and metabolic regulation.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Pharmacokinetic Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Tirzepatide's molecular structure has been designed to provide prolonged activity. Its fatty-acid-containing structure facilitates albumin binding, making the molecule useful for research into:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Peptide pharmacokinetics</li>
                      <li>Albumin binding</li>
                      <li>Plasma persistence</li>
                      <li>Molecular stability</li>
                      <li>Receptor exposure</li>
                      <li>Long-acting peptide design</li>
                    </ul>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Tirzepatide has been investigated extensively as a dual GIP and GLP-1 receptor agonist.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Preclinical research demonstrated that Tirzepatide produces activity at both GIP and GLP-1 receptors and can influence metabolic pathways associated with glucose regulation and energy balance.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">In a landmark clinical study published in the <em>New England Journal of Medicine</em>, Frias and colleagues investigated Tirzepatide in adults with type 2 diabetes. The study demonstrated dose-dependent effects on glycaemic measures and body weight while providing important evidence regarding the compound's pharmacodynamic profile.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Subsequent clinical research has expanded the scientific understanding of Tirzepatide across obesity, type 2 diabetes and related metabolic conditions. The SURPASS clinical programme investigated Tirzepatide extensively in type 2 diabetes, while the SURMOUNT programme examined its effects in obesity and overweight populations.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">These studies provide a substantial human evidence base for the compound's pharmacological activity. However, the clinical evidence should not be confused with evidence concerning a particular research-grade laboratory batch.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">For laboratory researchers, Tirzepatide remains particularly valuable as a model for investigating dual incretin signalling and metabolic regulation.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>
                    <p class="mb-1">Frias JP, et al. (2018). Tirzepatide versus Semaglutide Once Weekly in Patients with Type 2 Diabetes. <em>New England Journal of Medicine.</em></p>
                    <p class="text-xs text-muted-foreground">Research examining the pharmacological effects of dual GIP/GLP-1 receptor agonism.</p>
                  </li>
                  <li>
                    <p class="mb-1">Coskun T, et al. (2018). Tirzepatide is a novel dual GIP and GLP-1 receptor agonist. <em>Molecular Metabolism</em>, 18, 3–14.</p>
                    <p class="text-xs text-muted-foreground">PMID: 30287187 · DOI: 10.1016/j.molmet.2018.09.004. Preclinical evidence regarding Tirzepatide's dual receptor activity and metabolic effects.</p>
                  </li>
                  <li>
                    <p class="mb-1">Samson SL, et al. (2022). Effects of Tirzepatide on Glycemic Control in Patients With Type 2 Diabetes. <em>New England Journal of Medicine.</em></p>
                    <p class="text-xs text-muted-foreground">SURPASS-6 and related clinical research contributing to the wider understanding of Tirzepatide's metabolic effects.</p>
                  </li>
                  <li>
                    <p class="mb-1">Jastreboff AM, et al. (2022). Tirzepatide Once Weekly for the Treatment of Obesity. <em>New England Journal of Medicine.</em></p>
                    <p class="text-xs text-muted-foreground">Research from the SURMOUNT programme examining Tirzepatide in obesity.</p>
                  </li>
                  <li>Tirzepatide — PubChem Compound Database. Chemical and structural information for Tirzepatide, including molecular identification and physicochemical characteristics.</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Researchers should consult the original publications when assessing experimental findings, methodology and limitations.</p>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Tirzepatide Product Specifications</h2>
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
['Product Name', 'Tirzepatide'],
                        ['Vial Size', '3ml'],
                        ['Peptide Content', '10mg'],
                        ['Purity', '98.9%'],
                        ['Testing Method', 'HPLC'],
                        ['Receptor Profile', 'GIP + GLP-1 receptor agonist'],
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
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research peptide range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">This Tirzepatide batch is supplied with a stated 98.9% purity, with HPLC analysis used to assess peptide purity. Each batch is supported by a Certificate of Analysis (COA) providing analytical documentation for the supplied material.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Our quality-control approach is designed to give researchers clearly documented materials for controlled laboratory investigations and analytical research. Researchers should always refer to the relevant batch-specific COA when recording analytical characteristics for experimental work.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Tirzepatide may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>GIP receptor signalling</li>
                  <li>GLP-1 receptor signalling</li>
                  <li>Dual incretin biology</li>
                  <li>Glucose metabolism</li>
                  <li>Insulin signalling</li>
                  <li>Pancreatic beta-cell research</li>
                  <li>Glucagon regulation</li>
                  <li>Metabolic signalling</li>
                  <li>Energy-balance research</li>
                  <li>Adipose-tissue biology</li>
                  <li>Lipid metabolism</li>
                  <li>Peptide pharmacokinetics</li>
                  <li>Albumin-binding research</li>
                  <li>Long-acting peptide design</li>
                  <li>Analytical peptide research</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">Tirzepatide is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
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
                  <p>Tirzepatide supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>The scientific information presented on this page summarises published research concerning Tirzepatide and its pharmacological mechanisms. Research findings should not be interpreted as recommendations for human use or as evidence that a specific Research-Chem.uk batch has been clinically evaluated.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>