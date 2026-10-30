            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu is a copper-binding tripeptide complex consisting of glycyl-L-histidyl-L-lysine (GHK) associated with copper(II). GHK is a naturally occurring peptide that has been identified in human plasma and extracellular tissues and has been extensively investigated for its role in cellular signalling, extracellular-matrix remodelling and tissue-repair processes.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research into GHK-Cu has examined a range of biological processes, including collagen synthesis, fibroblast activity, extracellular-matrix regulation, angiogenesis and wound-healing responses. Research-Chem.uk supplies GHK-Cu as a laboratory research compound intended strictly for in-vitro, analytical and scientific research applications.</p>
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
['Product', 'GHK-Cu'],
                        ['Vial', '3ml'],
                        ['Peptide Content', '50mg'],
                        ['Purity', '99.6%'],
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

              <!--  What Is GHK-Cu?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is GHK-Cu?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu is the copper complex of glycyl-L-histidyl-L-lysine (GHK), a naturally occurring tripeptide. GHK has a strong affinity for copper(II) ions and can form the biologically relevant GHK-Cu complex. Research has identified GHK as a potential signalling molecule involved in processes associated with tissue remodelling and repair.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The peptide sequence GHK is also found within extracellular-matrix proteins, including collagen, and can be released during tissue breakdown and remodelling. This has led to considerable interest in GHK-Cu as a research model for investigating the relationship between peptide signalling, copper biology and extracellular-matrix regulation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The copper component is particularly relevant because copper is involved in several biological processes associated with connective-tissue formation and enzymatic activity. GHK's ability to bind copper provides a useful model for studying how small metal-binding peptides may influence cellular and extracellular processes.</p>
              </section>

              <!--  How Is GHK-Cu Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is GHK-Cu Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu has been investigated across cellular, biochemical and animal research models, particularly in relation to tissue remodelling and repair. Research has examined:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-4">
                  <li>Fibroblast activity</li>
                  <li>Collagen synthesis</li>
                  <li>Elastin and extracellular-matrix proteins</li>
                  <li>Glycosaminoglycan production</li>
                  <li>Metalloproteinase and tissue-inhibitor activity</li>
                  <li>Angiogenic signalling</li>
                  <li>Cellular migration</li>
                  <li>Wound-healing processes</li>
                  <li>Oxidative-stress responses</li>
                  <li>Inflammatory signalling</li>
                  <li>Skin and connective-tissue biology</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">In cultured fibroblasts, GHK-Cu has been associated with changes in collagen and extracellular-matrix production. Research has also examined its influence on matrix metalloproteinases (MMPs) and tissue inhibitors of metalloproteinases (TIMPs), which are important components of extracellular-matrix turnover.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">These characteristics make GHK-Cu a useful research compound for studying the molecular processes involved in cellular repair, extracellular-matrix turnover and tissue remodelling.</p>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">GHK-Cu Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Collagen and Extracellular-Matrix Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">One of the most established areas of GHK-Cu research concerns extracellular-matrix biology. Experimental studies have reported increased production of collagen and other matrix components following exposure to GHK-Cu. Research has also examined effects on glycosaminoglycans and proteoglycans such as decorin, which contribute to the structure and organisation of connective tissue. This makes GHK-Cu relevant to laboratory investigations into:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Type I collagen</li>
                      <li>Extracellular-matrix formation</li>
                      <li>Fibroblast function</li>
                      <li>Matrix remodelling</li>
                      <li>Connective-tissue biology</li>
                    </ul>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Fibroblast Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Fibroblasts play a central role in producing and organising extracellular-matrix components. GHK-Cu has been investigated in cultured fibroblasts, including studies examining collagen production, matrix-associated proteins and cellular responses to environmental stressors.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Wound-Healing Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">GHK-Cu has been studied extensively in experimental wound models. Animal research has investigated wound contraction, granulation tissue formation, collagen deposition, angiogenesis and inflammatory responses following exposure to GHK-Cu. Results across these models have provided evidence supporting further investigation of the peptide in tissue-repair research.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Angiogenesis Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Research has also examined GHK-Cu in relation to blood-vessel formation. Experimental work has reported effects on endothelial-cell activity and signalling molecules associated with angiogenesis, including VEGF and FGF-2. This makes GHK-Cu relevant to research investigating the interaction between extracellular-matrix signalling and vascular development.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Inflammatory and Oxidative-Stress Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">GHK-Cu has additionally been investigated in experimental models involving inflammatory signalling and oxidative stress. Research has examined changes in inflammatory mediators, antioxidant enzymes and cellular responses to oxidative damage, although the relevance of these findings varies considerably depending on the experimental model used.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Skin Biology Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">GHK-Cu has attracted particular interest in skin and dermal research because of its relationship with fibroblasts, collagen and extracellular-matrix turnover. Both laboratory and controlled topical-formulation studies have investigated changes in skin structure and matrix-associated parameters following GHK-Cu exposure.</p>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu has been investigated for several decades, with research spanning biochemical studies, cell cultures, animal models and topical human studies.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">A major area of interest is the peptide's relationship with extracellular-matrix remodelling. Studies have reported effects on collagen, glycosaminoglycans, proteoglycans and enzymes involved in matrix turnover. These findings provide a mechanistic basis for continued investigation into GHK-Cu and tissue-repair biology.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Experimental wound-healing studies have also produced encouraging findings. Animal models have reported changes in wound contraction, granulation tissue, collagen deposition, vascularisation and inflammatory markers following GHK-Cu exposure.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Research has additionally explored GHK-Cu's effects on endothelial cells and angiogenic signalling, providing another potential mechanism through which the peptide may influence tissue-remodelling environments.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">However, the evidence base should be interpreted appropriately. A substantial proportion of the literature is preclinical, while human evidence is more limited and includes topical cosmetic formulations rather than large-scale clinical investigations of purified research-grade GHK-Cu. For laboratory research purposes, GHK-Cu therefore represents an established model for investigating copper-peptide biology, extracellular-matrix regulation, fibroblast signalling and tissue-remodelling pathways.</p>
              </section>

              <!--  Research References  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Research References</h2>
                <ul class="text-sm text-muted-foreground leading-relaxed flex flex-col gap-3">
                  <li>
                    <p class="mb-1">Pickart L, et al. (2008). The human tri-peptide GHK and tissue remodeling. <em>Journal of Biomaterials Science, Polymer Edition.</em></p>
                    <p class="text-xs text-muted-foreground">PMID: 18644225</p>
                  </li>
                  <li>
                    <p class="mb-1">Pickart L, Margolina A. (2018). Regenerative and Protective Actions of the GHK-Cu Peptide in the Light of the New Gene Data. <em>International Journal of Molecular Sciences</em>, 19(7), 1987.</p>
                    <p class="text-xs text-muted-foreground">PMID: 29986520</p>
                  </li>
                  <li>
                    <p class="mb-1">Maquart FX, et al. (1996). Effect of tripeptide-copper complexes on the process of skin wound healing and on cultured fibroblasts. <em>Journal of Cellular and Molecular Medicine</em> / related experimental literature on GHK-Cu and wound repair.</p>
                    <p class="text-xs text-muted-foreground">PMID: 8836453</p>
                  </li>
                  <li>GHK Peptide as a Natural Modulator of Multiple Cellular Pathways in Skin Regeneration. Review of GHK and GHK-Cu research covering extracellular-matrix regulation, fibroblast activity, wound healing and skin biology.</li>
                  <li>Local and Systemic Peptide Therapies for Soft Tissue Regeneration: A Narrative Review. Review covering GHK-Cu research in wound healing, tissue regeneration and experimental models.</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Researchers should consult the original publications when assessing experimental methodology, participant populations, endpoints, pharmacological findings and study limitations.</p>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">GHK-Cu Product Specifications</h2>
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
['Product Name', 'GHK-Cu'],
                        ['Vial Size', '3ml'],
                        ['Peptide Content', '50mg'],
                        ['Purity', '99.6%'],
                        ['Testing Method', 'HPLC'],
                        ['Peptide', 'Glycyl-L-Histidyl-L-Lysine Copper Complex'],
                        ['Molecular Type', 'Copper-binding tripeptide complex'],
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
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">GHK-Cu refers to the copper-associated form of the naturally occurring tripeptide glycyl-L-histidyl-L-lysine. Its chemical behaviour is closely related to the peptide's ability to coordinate copper(II) ions.</p>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research peptide range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">This GHK-Cu batch is supplied with a stated 99.6% purity, with HPLC analysis used to assess peptide purity. Each batch is supported by a Certificate of Analysis (COA) providing analytical documentation for the supplied material.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Our quality-control approach is designed to provide researchers with clearly documented materials for controlled laboratory investigations and analytical work.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>Extracellular-matrix biology</li>
                  <li>Collagen synthesis research</li>
                  <li>Fibroblast research</li>
                  <li>Connective-tissue biology</li>
                  <li>Wound-healing models</li>
                  <li>Angiogenesis research</li>
                  <li>Cellular migration studies</li>
                  <li>Copper-peptide interactions</li>
                  <li>Metalloproteinase research</li>
                  <li>Oxidative-stress studies</li>
                  <li>Inflammatory signalling research</li>
                  <li>Skin and dermal biology</li>
                  <li>Analytical peptide research</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">GHK-Cu is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
              </section>

              <!--  Why Choose Research-Chem.uk?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research-Chem.uk provides research peptides for laboratories, analytical researchers and other qualified research environments. Our peptide range focuses on:</p>
                <div class="flex flex-col gap-4">
                  @php
$whyChooseItems = [
['HPLC-Verified Purity', 'Every peptide is subjected to analytical purity testing, with batch-specific documentation available.'],
                    ['Batch Traceability', 'Products are supplied with Certificate of Analysis documentation to support laboratory record keeping and material identification.'],
                    ['UK Dispatch', 'Research compounds are dispatched from the UK for efficient domestic delivery.'],
                    ['Research-Only Positioning', 'Our products are supplied exclusively for legitimate laboratory research and analytical applications.'],
                    ['Clear Product Specifications', 'Each product page provides defined peptide content, purity information and relevant scientific information where available.'],
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
                  <p>GHK-Cu supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>