            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Product Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GLOW GHK-Cu + BPC-157 + TB-500 is a multi-peptide research formulation combining three compounds that have each been investigated in experimental models involving tissue biology, cellular signalling, wound repair and extracellular-matrix processes.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">The formulation brings together GHK-Cu, a copper-binding tripeptide associated with extracellular-matrix and connective-tissue research; BPC-157, a synthetic pentadecapeptide investigated extensively in preclinical tissue-repair models; and TB-500, a research peptide associated with the biologically active region of thymosin beta-4 and investigated in relation to cellular migration, angiogenesis and tissue-repair pathways. Research-Chem.uk supplies GLOW as a laboratory research compound intended strictly for in-vitro, analytical and scientific research applications.</p>
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
['Product', 'GLOW GHK-Cu + BPC-157 + TB-500'],
                        ['Vial', '3ml'],
                        ['Total Peptide Content', '70mg'],
                        ['Purity', 'Research-grade peptide blend'],
                        ['Testing', 'HPLC analysis'],
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

              <!--  What Is GLOW?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Is GLOW GHK-Cu + BPC-157 + TB-500?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GLOW is a multi-component peptide research formulation containing three distinct research compounds:</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3"><strong class="text-foreground">GHK-Cu</strong> is the copper-associated form of glycyl-L-histidyl-L-lysine (GHK). It has been investigated extensively in extracellular-matrix biology, fibroblast activity, collagen-related processes, wound-healing models and cellular signalling.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3"><strong class="text-foreground">BPC-157</strong> is a synthetic pentadecapeptide that has been investigated predominantly in preclinical models. Published research has examined its relationship with wound repair, vascular responses, cellular signalling and tissue-protection mechanisms.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3"><strong class="text-foreground">TB-500</strong> is a name commonly used for a synthetic peptide associated with the active region of thymosin beta-4. Research on thymosin beta-4 has investigated actin regulation, cellular migration, angiogenesis and wound-healing processes.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">These peptides therefore provide a research model in which multiple biological pathways associated with cellular repair and tissue remodelling can be investigated within the same experimental formulation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Importantly, the individual peptides remain chemically distinct compounds, and research findings relating to one component should not automatically be attributed to the complete GLOW formulation.</p>
              </section>

              <!--  How Is GLOW Investigated in Research?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">How Is GLOW Investigated in Research?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research involving the individual components of GLOW has explored several interconnected biological processes.</p>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">GHK-Cu</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">GHK-Cu has been investigated in relation to:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>Fibroblast activity</li>
                      <li>Collagen production</li>
                      <li>Extracellular-matrix regulation</li>
                      <li>Matrix metalloproteinases</li>
                      <li>Glycosaminoglycans</li>
                      <li>Cellular migration</li>
                      <li>Angiogenic signalling</li>
                      <li>Wound-healing models</li>
                      <li>Oxidative-stress responses</li>
                    </ul>
                    <p class="text-sm text-muted-foreground leading-relaxed">Research reviews describe GHK-Cu as a peptide with substantial preclinical interest in tissue remodelling and repair.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">BPC-157</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">BPC-157 has been investigated primarily in animal and laboratory models involving:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>Wound healing</li>
                      <li>Vascular responses</li>
                      <li>Tissue repair</li>
                      <li>Cellular signalling</li>
                      <li>Inflammatory pathways</li>
                      <li>Gastrointestinal biology</li>
                      <li>Tendon and connective-tissue models</li>
                    </ul>
                    <p class="text-sm text-muted-foreground leading-relaxed">The available literature is predominantly preclinical, with recent reviews highlighting the substantial gap between experimental findings and validated human clinical evidence.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">TB-500 / Thymosin Beta-4 Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">Thymosin beta-4 research has investigated mechanisms involving:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-2">
                      <li>Actin regulation</li>
                      <li>Cellular migration</li>
                      <li>Angiogenesis</li>
                      <li>Fibroblast activity</li>
                      <li>Extracellular-matrix remodelling</li>
                      <li>Wound closure</li>
                      <li>Inflammatory signalling</li>
                    </ul>
                    <p class="text-sm text-muted-foreground leading-relaxed">Research reviews have reported effects across several experimental wound-healing models, although the evidence base varies depending on whether the study concerns full-length thymosin beta-4 or the TB-500-associated peptide fragment.</p>
                  </div>
                </div>
              </section>

              <!--  Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">GLOW GHK-Cu + BPC-157 + TB-500 Research Applications</h2>
                <div class="flex flex-col gap-5">
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Tissue-Repair Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">The three components of GLOW have individually been investigated in experimental models involving tissue repair. GHK-Cu research focuses strongly on extracellular-matrix regulation and fibroblast biology, while BPC-157 and thymosin beta-4 research has investigated cellular responses associated with tissue recovery. This makes the blend relevant to laboratory studies examining interconnected tissue-repair pathways.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Extracellular-Matrix Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">GHK-Cu provides a particularly useful model for studying extracellular-matrix biology. Research has examined collagen production, proteoglycans, glycosaminoglycans and matrix metalloproteinase activity following GHK/GHK-Cu exposure. The inclusion of multiple peptides allows researchers to investigate how different peptide-associated signalling pathways may interact within experimental models of matrix remodelling.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Fibroblast and Cellular-Migration Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Fibroblasts are central to extracellular-matrix production and tissue remodelling. GHK-Cu has been studied in fibroblast systems, while thymosin beta-4 research has investigated cellular migration and cytoskeletal processes associated with actin dynamics.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Angiogenesis Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">Angiogenesis is an important component of tissue repair and remodelling. Research involving GHK-Cu and thymosin beta-4 has investigated endothelial-cell activity and signalling pathways associated with new blood-vessel formation. BPC-157 has also been investigated in preclinical models involving vascular responses and angiogenic mechanisms.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Wound-Healing Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed">All three components have appeared in experimental research relating to wound biology, although the quantity and quality of evidence differ substantially between compounds. GHK-Cu research has investigated collagen deposition, fibroblast activation, angiogenesis and wound contraction, while thymosin beta-4 has been studied in models of wound closure and tissue repair. BPC-157 has also demonstrated biological activity in numerous animal wound models.</p>
                  </div>
                  <div>
                    <h3 class="text-base font-semibold mb-2 text-primary">Cellular Signalling Research</h3>
                    <p class="text-sm text-muted-foreground leading-relaxed mb-2">The GLOW formulation may also be used as a research model for examining multiple peptide-associated signalling pathways simultaneously. Potential areas of investigation include:</p>
                    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                      <li>Cytoskeletal signalling</li>
                      <li>Extracellular-matrix turnover</li>
                      <li>Cellular migration</li>
                      <li>Fibroblast signalling</li>
                      <li>Vascular signalling</li>
                      <li>Inflammatory pathways</li>
                      <li>Oxidative-stress responses</li>
                      <li>Tissue-remodelling mechanisms</li>
                    </ul>
                  </div>
                </div>
              </section>

              <!--  What Does the Research Say?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">What Does the Research Say?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The scientific rationale behind GLOW comes from the individual research profiles of its three components, rather than from clinical evidence specifically evaluating the combined GHK-Cu + BPC-157 + TB-500 formulation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GHK-Cu has one of the more established experimental research histories of the three components in relation to extracellular-matrix biology. Research has reported effects involving collagen, fibroblasts, proteoglycans, matrix metalloproteinases and wound-healing responses.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">BPC-157 has generated extensive preclinical literature, particularly involving wound and tissue-repair models. However, recent scientific reviews continue to emphasise that the majority of evidence remains preclinical and that significant translational and pharmaceutical-development questions remain unresolved.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Thymosin beta-4 research has produced evidence relating to actin regulation, cellular migration, angiogenesis and wound repair. Reviews have described activity across multiple experimental models while also noting the need for further research to establish the clinical relevance of these findings.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">A recent 2026 review examining several emerging peptides, including BPC-157, GHK-Cu and TB-500, concluded that much of the available literature consists of preclinical work and that robust human efficacy and safety data remain limited.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">For this reason, GLOW is best positioned as a multi-peptide laboratory research formulation for investigating complementary biological pathways rather than as a clinically validated therapeutic product.</p>
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
                  <li>BPC-157 Research Review. Stable Gastric Pentadecapeptide BPC 157 and Wound Healing. Review of experimental BPC-157 research involving wound-healing and tissue-repair models.</li>
                  <li>Thymosin Beta-4 Research Review. Research advances on thymosin β4 in promoting wound healing. Review of thymosin beta-4 molecular mechanisms, angiogenesis and experimental wound repair.</li>
                  <li>Progress on the Function and Application of Thymosin β4. Review covering actin regulation, cellular migration, angiogenesis and wound-healing research involving thymosin beta-4.</li>
                  <li>Safety and Efficacy of Approved and Unapproved Peptide Therapies for Musculoskeletal Injuries and Athletic Performance (2026). Recent review examining BPC-157, GHK-Cu, TB-500 and other emerging peptide compounds, with particular emphasis on the limitations of current human evidence.</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">Researchers should consult the original publications when assessing experimental methodology, results, limitations and the distinction between individual peptide components and the combined formulation.</p>
              </section>

              <!--  Product Specifications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">GLOW GHK-Cu + BPC-157 + TB-500 Product Specifications</h2>
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
['Product Name', 'GLOW GHK-Cu + BPC-157 + TB-500'],
                        ['Vial Size', '3ml'],
                        ['Total Peptide Content', '70mg'],
                        ['Purity', 'Research-grade peptide blend'],
                        ['Components', 'GHK-Cu + BPC-157 + TB-500'],
                        ['Testing Method', 'HPLC'],
                        ['Physical Form', 'Lyophilised peptide blend'],
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
                <p class="text-sm text-muted-foreground leading-relaxed mt-3">The 70mg specification represents the total peptide content of the formulation. Individual component quantities are not stated here as the specific GHK-Cu/BPC-157/TB-500 formulation ratio has not been provided.</p>
              </section>

              <!--  Quality and Purity  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Purity</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">At Research-Chem.uk, analytical quality and batch traceability are central to our research peptide range.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GLOW GHK-Cu + BPC-157 + TB-500 is supplied as a defined 70mg multi-peptide research formulation in a 3ml vial. HPLC analysis is used as part of the analytical quality-control process, with batch-specific documentation available to support laboratory identification and research records.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Each supplied batch is accompanied by Certificate of Analysis (COA) documentation. For multi-component peptide formulations, researchers should refer to the relevant batch documentation for the analytical characteristics of the individual components and overall formulation.</p>
              </section>

              <!--  Laboratory Research Applications  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">GLOW GHK-Cu + BPC-157 + TB-500 may be suitable for laboratory investigations involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
                  <li>Tissue-remodelling research</li>
                  <li>Extracellular-matrix biology</li>
                  <li>Fibroblast research</li>
                  <li>Collagen-related studies</li>
                  <li>Cellular migration</li>
                  <li>Angiogenesis research</li>
                  <li>Wound-healing models</li>
                  <li>Vascular signalling</li>
                  <li>Inflammatory signalling</li>
                  <li>Oxidative-stress research</li>
                  <li>Cytoskeletal biology</li>
                  <li>Matrix metalloproteinase research</li>
                  <li>Peptide interaction studies</li>
                  <li>Multi-peptide experimental models</li>
                  <li>Analytical peptide research</li>
                </ul>
                <p class="text-sm text-muted-foreground leading-relaxed">The formulation is supplied strictly as a research compound and is not intended to diagnose, treat, cure or prevent any disease or medical condition.</p>
              </section>

              <!--  Why Choose Research-Chem.uk?  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-4">Research-Chem.uk provides research peptides and peptide formulations for laboratories, analytical researchers and other qualified research environments. Our range focuses on:</p>
                <div class="flex flex-col gap-4">
                  @php
$whyChooseItems = [
['HPLC-Verified Materials', 'Peptide products are subjected to analytical purity assessment, with batch-specific documentation available.'],
                    ['Batch Traceability', 'Products are supplied with Certificate of Analysis documentation to support laboratory record keeping and material identification.'],
                    ['UK Dispatch', 'Research compounds are dispatched from the UK for efficient domestic delivery.'],
                    ['Research-Only Positioning', 'Products are supplied exclusively for legitimate laboratory research and analytical applications.'],
                    ['Clear Product Specifications', 'Each product page provides defined information about peptide content, formulation and relevant research characteristics.'],
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
                  <p>GLOW GHK-Cu + BPC-157 + TB-500 supplied by Research-Chem.uk is intended strictly for in-vitro laboratory research, analytical testing and scientific investigation.</p>
                  <p>This product is not a medicine, pharmaceutical preparation, dietary supplement or food product. It is not intended for human consumption, self-administration, diagnosis, treatment, cure or prevention of any disease or medical condition.</p>
                  <p>The scientific information provided on this page describes published research involving the individual peptide components and should not be interpreted as evidence that the complete GLOW formulation has been clinically evaluated.</p>
                  <p>Researchers and laboratories are responsible for ensuring that all use, handling, storage, testing and disposal procedures comply with applicable legislation, institutional requirements and laboratory safety protocols.</p>
                  <p><strong class="text-accent">For qualified researchers and controlled laboratory research use only.</strong></p>
                </div>
              </div>

            </div>