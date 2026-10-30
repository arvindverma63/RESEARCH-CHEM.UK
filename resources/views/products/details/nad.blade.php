            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ (Nicotinamide Adenine Dinucleotide) is a naturally occurring coenzyme found in virtually all living cells. It plays a fundamental role in cellular metabolism, particularly in oxidation-reduction reactions, mitochondrial energy production, DNA repair and cellular signalling.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ exists in oxidised and reduced forms, with the NAD+/NADH redox pair acting as an important electron-transfer system in metabolic pathways.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Beyond its role in energy metabolism, NAD+ is involved in several enzyme-mediated signalling processes, including reactions involving sirtuins, PARP enzymes and CD38/CD157, making NAD+ an important subject of research into cellular ageing, metabolic regulation, DNA damage and mitochondrial biology. Research-Chem.uk supplies NAD+ as a laboratory research compound intended strictly for in-vitro, analytical and scientific research applications.</p>
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
['Product', 'NAD+'],
                        ['Vial', '10ml'],
                        ['NAD+ Content', '500mg'],
                        ['Purity', '99.5%'],
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

              <!--  What Is NAD+?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is NAD+?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ stands for nicotinamide adenine dinucleotide. It is a dinucleotide consisting of two nucleotide components linked through their phosphate groups. One nucleotide contains an adenine base, while the other contains nicotinamide.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ is central to cellular metabolism because it can accept electrons to form NADH. The reversible NAD+/NADH pair allows cells to transfer reducing equivalents between metabolic reactions.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The NAD+/NADH system is particularly important within pathways such as:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>Glycolysis</li>
                  <li>The citric acid cycle</li>
                  <li>Fatty-acid oxidation</li>
                  <li>Oxidative phosphorylation</li>
                  <li>Cellular redox regulation</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">NAD+ also serves as a substrate for several enzyme families. These include sirtuins, which use NAD+ during deacetylation reactions, and poly(ADP-ribose) polymerases (PARPs), which consume NAD+ during DNA-damage signalling. This combination of metabolic and signalling functions makes NAD+ an important research molecule across biochemistry, molecular biology and cellular physiology.</p>
              </section>

              <!--  How Is NAD+ Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is NAD+ Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ is investigated extensively in cellular, biochemical and molecular research. Experimental research has examined:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>Cellular energy metabolism</li>
                  <li>Mitochondrial function</li>
                  <li>Redox balance</li>
                  <li>NAD+/NADH ratios</li>
                  <li>DNA repair</li>
                  <li>Sirtuin activity</li>
                  <li>PARP activity</li>
                  <li>CD38/CD157 signalling</li>
                  <li>Cellular senescence</li>
                  <li>Metabolic regulation</li>
                  <li>Oxidative stress</li>
                  <li>Mitochondrial ageing</li>
                  <li>Gene regulation</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">A particularly important area of research concerns the relationship between NAD+ availability and cellular metabolism. NAD+ is continuously consumed and regenerated through multiple biochemical pathways. Cellular NAD+ concentrations therefore reflect a dynamic balance between synthesis, utilisation and salvage.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Researchers can investigate these pathways by measuring NAD+ and NADH concentrations or by manipulating enzymes involved in NAD+ biosynthesis and consumption.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">NAD+ Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Energy Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">NAD+ is essential to the transfer of electrons during cellular respiration. Within glycolysis and the citric acid cycle, NAD+ accepts electrons and is converted to NADH. NADH subsequently participates in mitochondrial oxidative phosphorylation. This makes NAD+ relevant to research involving:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>ATP production</li>
                      <li>Cellular respiration</li>
                      <li>Mitochondrial metabolism</li>
                      <li>Electron transport</li>
                      <li>Oxidative phosphorylation</li>
                      <li>Energy-demanding tissues</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Mitochondrial Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Mitochondria rely heavily on NAD+-dependent metabolic reactions. Research into NAD+ has therefore examined mitochondrial function, respiratory capacity and metabolic flexibility. Changes in NAD+ availability can influence the activity of metabolic enzymes and NAD+-dependent signalling proteins, providing a useful experimental model for investigating mitochondrial physiology.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">DNA-Repair Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">NAD+ serves as a substrate for PARP enzymes, which are activated by certain forms of DNA damage. PARP activity can consume substantial amounts of cellular NAD+ under conditions of increased DNA damage. This creates an important connection between NAD+ metabolism and DNA-repair research. Experimental studies can therefore investigate:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>DNA damage</li>
                      <li>PARP activation</li>
                      <li>NAD+ consumption</li>
                      <li>DNA repair pathways</li>
                      <li>Cellular stress responses</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Sirtuin Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Sirtuins are NAD+-dependent enzymes involved in protein deacetylation and other signalling reactions. Because sirtuin activity depends directly on NAD+, NAD+ availability is an important variable in research investigating:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Protein acetylation</li>
                      <li>Gene regulation</li>
                      <li>Metabolic signalling</li>
                      <li>Mitochondrial function</li>
                      <li>Cellular stress responses</li>
                      <li>Age-associated molecular changes</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Ageing Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">NAD+ metabolism has become an important area of ageing research. Studies have reported changes in NAD+ metabolism during ageing and have investigated the enzymes responsible for NAD+ synthesis, salvage and consumption. Researchers have therefore examined the relationship between NAD+ availability and:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>Cellular senescence</li>
                      <li>Mitochondrial function</li>
                      <li>DNA repair</li>
                      <li>Sirtuin activity</li>
                      <li>Metabolic resilience</li>
                      <li>Age-associated cellular changes</li>
                    </ul>
                    <p class="text-sm text-muted-foreground leading-relaxed">Importantly, these research findings do not establish NAD+ itself as an anti-ageing treatment. The biological mechanisms are complex and depend on tissue, cellular context and NAD+ metabolic pathways.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Oxidative-Stress Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">NAD+/NADH is a major component of cellular redox biology. The ratio between oxidised NAD+ and reduced NADH provides information about the redox state of cells and can change in response to metabolic or oxidative stress. NAD+ can therefore be used in experimental systems examining:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Redox balance</li>
                      <li>Reactive oxygen species</li>
                      <li>Oxidative stress</li>
                      <li>Mitochondrial dysfunction</li>
                      <li>Metabolic stress</li>
                    </ul>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ has one of the most established biochemical roles in cellular biology. Its importance was recognised long before modern longevity research because NAD+ is fundamental to cellular respiration and redox metabolism.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">More recent research has expanded the understanding of NAD+ beyond its traditional role as an electron carrier. NAD+ is now recognised as a substrate for enzymes involved in cellular signalling, including sirtuins and PARPs. This creates a connection between NAD+ metabolism, energy production, DNA repair and cellular stress responses.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Research into ageing has also identified changes in NAD+ metabolism in multiple tissues. A decline in NAD+ availability has been investigated as one component of the broader metabolic changes associated with ageing, although the mechanisms are complex and vary between biological systems.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">A major area of research is therefore the NAD+ salvage pathway, particularly the conversion of nicotinamide back into NAD+. Enzymes including NAMPT play important roles in maintaining intracellular NAD+ pools.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Other research has focused on NAD+-consuming enzymes such as PARPs and CD38. These pathways provide important mechanisms through which NAD+ availability can change under conditions of DNA damage, inflammation and cellular stress.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The growing research interest in NAD+ therefore encompasses much more than energy metabolism. It includes the interaction between metabolic state, mitochondrial function, DNA repair and cellular signalling. For laboratory research, NAD+ provides a well-established biochemical substrate for investigating these interconnected pathways.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>
                    <p class="mb-1">Bender E, et al. (2019). NAD+ metabolism in health and disease. <em>Nature Reviews Molecular Cell Biology.</em></p>
                    <p>Review examining NAD+ biosynthesis, consumption and cellular signalling.</p>
                  </li>
                  <li>
                    <p class="mb-1">Rajman L, Chwalek K, Sinclair DA. (2018). Therapeutic Potential of NAD-Boosting Molecules: The In Vivo Evidence. <em>Cell Metabolism</em>, 27(3), 529–547.</p>
                    <p class="text-xs text-muted-foreground">PMID: 29415893 · DOI: 10.1016/j.cmet.2018.02.011</p>
                  </li>
                  <li>
                    <p class="mb-1">Katsyuba E, Auwerx J. (2017). Modulating NAD+ metabolism, from bench to bedside. <em>The EMBO Journal</em>, 36(18), 2670–2683.</p>
                    <p class="text-xs text-muted-foreground">PMID: 28808120 · DOI: 10.15252/embj.201797135</p>
                  </li>
                  <li>
                    <p class="mb-1">Covarrubias AJ, Perrone R, Grozio A, Verdin E. (2021). AMPK and NAD+ metabolism in the regulation of aging. <em>Molecular Cell</em>, 81(2), 399–416.</p>
                    <p>Research examining the relationship between NAD+ metabolism, cellular energy sensing and ageing-associated pathways.</p>
                  </li>
                  <li>
                    <p class="mb-1">Verdin E. (2015). NAD+ in aging, metabolism, and neurodegeneration. <em>Science</em>, 350(6265), 1208–1213.</p>
                    <p class="text-xs text-muted-foreground">PMID: 26785480 · DOI: 10.1126/science.aac4854</p>
                  </li>
                </ul>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">NAD+ Product Specifications</h2>
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
['Product Name', 'NAD+'],
                        ['Full Name', 'Nicotinamide Adenine Dinucleotide'],
                        ['Vial Size', '10ml'],
                        ['NAD+ Content', '500mg'],
                        ['Purity', '99.5%'],
                        ['Testing Method', 'HPLC'],
                        ['Compound Type', 'Dinucleotide coenzyme'],
                        ['Redox Pair', 'NAD+ / NADH'],
                        ['Physical Form', 'Laboratory research material'],
                        ['Intended Application', 'Laboratory research only'],
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
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">NAD+ is a nucleotide-derived coenzyme rather than a peptide. Its biological role is primarily associated with electron transfer, cellular metabolism and NAD+-dependent enzyme activity.</p>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research compound range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">This NAD+ batch is supplied with a stated 99.5% purity, with HPLC analysis used to assess the supplied material. Each batch is supported by a Certificate of Analysis (COA) providing analytical documentation for the supplied material.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The product is supplied in a 10ml vial containing 500mg of NAD+. Researchers should always refer to the relevant batch-specific COA when recording analytical characteristics for experimental work.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">NAD+ may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>Cellular metabolism</li>
                  <li>Mitochondrial biology</li>
                  <li>Oxidative phosphorylation</li>
                  <li>Redox biology</li>
                  <li>NAD+/NADH metabolism</li>
                  <li>ATP production</li>
                  <li>DNA-repair pathways</li>
                  <li>PARP biology</li>
                  <li>Sirtuin research</li>
                  <li>CD38-related research</li>
                  <li>Cellular senescence</li>
                  <li>Oxidative-stress models</li>
                  <li>Metabolic signalling</li>
                  <li>Age-associated cellular processes</li>
                  <li>Enzyme kinetics</li>
                  <li>Biochemical research</li>
                  <li>Analytical research</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">NAD+ is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
              </section>

              <!--  Why Choose Research-Chem.uk?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research-Chem.uk provides research compounds and peptides for laboratories, analytical researchers and other qualified research environments. Our range focuses on:</p>
                <div class="flex flex-col gap-4">
                  @php
$whyChooseItems = [
['HPLC-Verified Purity', 'Products are subjected to analytical purity assessment, with batch-specific documentation available.'],
                    ['Batch Traceability', 'Products are supplied with Certificate of Analysis documentation to support laboratory record keeping and material identification.'],
                    ['UK Dispatch', 'Research compounds are dispatched from the UK for efficient domestic delivery.'],
                    ['Research-Only Positioning', 'Our products are supplied exclusively for legitimate laboratory research and analytical applications.'],
                    ['Clear Product Specifications', 'Each product page provides defined information about compound content, purity and relevant scientific characteristics.'],
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
                  <p>NAD+ supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>The scientific information presented on this page summarises published research concerning NAD+ biology and metabolism. Experimental findings should not be interpreted as recommendations for human use or as evidence that this particular Research-Chem.uk batch has been clinically evaluated.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>