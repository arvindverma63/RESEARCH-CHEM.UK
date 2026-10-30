            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon is a synthetic tetrapeptide commonly identified as Epitalon or Epithalone. It is derived from research into epithalamin, a pineal-gland-associated peptide preparation, and has been investigated in experimental studies examining cellular ageing, telomere biology, oxidative stress and longevity-associated pathways.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Epithalon has attracted scientific interest because of research suggesting potential interactions with cellular processes associated with ageing and replicative senescence. Experimental literature has investigated its effects on telomerase activity, telomere-associated mechanisms, antioxidant systems and gene expression. Research-Chem.uk supplies Epithalon as a laboratory research compound intended strictly for in-vitro, analytical and scientific research applications.</p>
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
['Product', 'Epithalon'],
                        ['Vial', '3ml'],
                        ['Peptide Content', '10mg'],
                        ['Purity', '98.7%'],
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

              <!--  What Is Epithalon?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is Epithalon?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon is a synthetic tetrapeptide consisting of the amino acids Ala-Glu-Asp-Gly (AEDG).</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The peptide is closely associated with research conducted into epithalamin, a peptide preparation originally studied in relation to the pineal gland and age-associated biological processes.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon subsequently became the subject of experimental research as a defined synthetic peptide. Studies have investigated whether the compound influences biological pathways associated with cellular ageing, including telomerase activity, telomere maintenance and oxidative-stress responses.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The scientific interest surrounding Epithalon therefore centres primarily on its potential interaction with cellular ageing and longevity-associated mechanisms, rather than on conventional peptide-receptor pharmacology.</p>
              </section>

              <!--  How Is Epithalon Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is Epithalon Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon has been studied using a combination of cellular, biochemical and animal research models. Experimental investigations have examined:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>Telomerase activity</li>
                  <li>Telomere length and maintenance</li>
                  <li>Cellular senescence</li>
                  <li>Gene-expression patterns</li>
                  <li>Oxidative stress</li>
                  <li>Antioxidant defence systems</li>
                  <li>DNA-damage responses</li>
                  <li>Pineal-gland biology</li>
                  <li>Circadian-related processes</li>
                  <li>Age-associated cellular changes</li>
                  <li>Longevity-associated pathways</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">One of the principal areas of interest is the relationship between Epithalon and telomerase, the enzyme complex responsible for maintaining telomere ends in certain cell types.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Telomeres are protective DNA-protein structures located at chromosome ends. Their progressive shortening during cellular replication is associated with replicative senescence in many somatic cell systems, making telomere biology an important area of ageing research.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Epithalon Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Telomere and Telomerase Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Epithalon has received considerable attention in research investigating telomere biology. Experimental studies have reported changes in telomerase-related activity following exposure to Epithalon or related peptide preparations. This makes the compound relevant to laboratory investigations examining:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>Telomerase activity</li>
                      <li>Telomere maintenance</li>
                      <li>Replicative senescence</li>
                      <li>Cellular lifespan</li>
                      <li>Chromosomal stability</li>
                    </ul>
                    <p class="text-sm text-muted-foreground leading-relaxed">However, telomere biology is highly cell-type dependent, and findings from specific experimental models should not automatically be extrapolated to whole-organism ageing.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Ageing Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Epithalon has been investigated as a research tool for studying biological processes associated with cellular ageing. Research models may examine changes in:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Cellular proliferation</li>
                      <li>Senescence markers</li>
                      <li>Gene expression</li>
                      <li>DNA stability</li>
                      <li>Oxidative stress</li>
                      <li>Cellular stress responses</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Oxidative-Stress Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Oxidative stress is an important component of ageing and cellular damage research. Experimental studies involving Epithalon have examined antioxidant defence mechanisms and changes in oxidative-stress-related markers. This provides a research framework for studying the relationship between peptide signalling, oxidative balance and cellular resilience.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Gene-Expression Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Research involving Epithalon has also examined changes in gene-expression patterns. These investigations have explored whether the peptide can influence genes and pathways associated with:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Cellular stress</li>
                      <li>Antioxidant activity</li>
                      <li>DNA repair</li>
                      <li>Cellular proliferation</li>
                      <li>Age-associated processes</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Pineal-Gland Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Epithalon's origins in research into epithalamin have led to continued interest in pineal-gland biology. Experimental research has examined relationships between pineal-derived peptides, ageing and endocrine or circadian-associated processes.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Longevity Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Epithalon is frequently discussed within experimental longevity research because of its proposed interactions with cellular ageing pathways. Animal and cellular studies have investigated survival, age-associated changes and markers of biological ageing. However, these findings remain within the context of experimental research and should not be interpreted as evidence of an established anti-ageing treatment.</p>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon has a distinctive research history compared with many contemporary peptide compounds.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Early work centred on epithalamin, a pineal peptide preparation studied by researchers investigating age-associated changes and longevity. Subsequent research examined the synthetic tetrapeptide Epithalon as a defined compound.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">One of the most frequently cited areas of research concerns telomerase and telomere biology. Experimental studies have reported increased telomerase-related activity and changes in telomere-associated parameters in particular cellular models.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Research has also investigated Epithalon in relation to oxidative stress and antioxidant defence mechanisms. Experimental findings have suggested changes in markers associated with oxidative damage and cellular protection.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Animal studies have further contributed to the interest in Epithalon as a longevity-research compound, although the translation of these findings into human biology remains uncertain.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">It is important to distinguish between experimental observations and clinically established effects. Although Epithalon has been investigated for many years, the modern evidence base does not establish it as a clinically validated anti-ageing intervention. For laboratory research, its principal value lies in providing a defined peptide model for investigating telomere biology, cellular senescence, oxidative stress and longevity-associated mechanisms.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>Khavinson VK, et al. Research investigating short peptide bioregulators, including Epithalon, and their relationship with cellular ageing and telomerase activity.</li>
                  <li>Khavinson VK, Popov AN. Experimental research into Epithalon and telomerase activity in human cell cultures.</li>
                  <li>Khavinson VK, et al. Studies investigating Epithalon, gene expression and age-associated cellular processes.</li>
                  <li>Epitalon and ageing-related research. A body of experimental literature has examined the synthetic tetrapeptide AEDG in relation to telomerase, oxidative stress, gene expression and longevity-associated mechanisms.</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Researchers should consult the original publications and experimental methodologies when evaluating individual findings, as study design, biological model and peptide preparation can differ substantially between investigations.</p>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Epithalon Product Specifications</h2>
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
['Product Name', 'Epithalon'],
                        ['Alternative Names', 'Epitalon / Epithalone'],
                        ['Vial Size', '3ml'],
                        ['Peptide Content', '10mg'],
                        ['Purity', '98.7%'],
                        ['Peptide Sequence', 'Ala-Glu-Asp-Gly (AEDG)'],
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
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Epithalon is a synthetic tetrapeptide consisting of alanine, glutamic acid, aspartic acid and glycine (AEDG).</p>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research peptide range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">This Epithalon batch is supplied with a stated 98.7% purity, with HPLC analysis used to assess peptide purity. Each batch is supported by a Certificate of Analysis (COA) providing analytical documentation for the supplied material.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Our quality-control approach is designed to give researchers clearly documented materials for controlled laboratory investigations and analytical research. Researchers should always refer to the relevant batch-specific COA when recording analytical characteristics for experimental work.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Epithalon may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>Telomerase research</li>
                  <li>Telomere biology</li>
                  <li>Cellular senescence</li>
                  <li>Cellular ageing models</li>
                  <li>Oxidative-stress research</li>
                  <li>Antioxidant pathways</li>
                  <li>Gene-expression studies</li>
                  <li>DNA-damage research</li>
                  <li>Chromosomal biology</li>
                  <li>Pineal-gland research</li>
                  <li>Circadian biology</li>
                  <li>Longevity-associated pathways</li>
                  <li>Peptide biochemistry</li>
                  <li>Analytical peptide research</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">Epithalon is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
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
                  <p>Epithalon supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>The scientific information presented on this page summarises experimental research concerning Epithalon and related peptide preparations. Experimental findings should not be interpreted as recommendations for human use or as evidence that Epithalon is an established anti-ageing or longevity treatment.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>