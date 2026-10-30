            <div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

              <!--  Overview  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Wolverine Peptide Pen Kits for Controlled Laboratory Research</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">For laboratories investigating BPC-157 and TB-500, peptide pen kits offer an alternative research format to conventional vial-based preparations. Their compact, controlled-delivery design can be particularly useful when experimental protocols require consistent volumes, repeatable delivery and controlled sample handling across multiple research observations.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The Wolverine peptide formulation combines two distinct research peptides — BPC-157 and TB-500 — within a single research configuration. Research-Chem.uk analytical documentation reports a 20mg total peptide formulation, with the BPC-157 component independently analysed at 98.5% HPLC purity and the TB-500 component at 99.2% HPLC purity.</p>
                <div class="overflow-x-auto">
                  <table class="w-full text-sm border-collapse">
                    <thead>
                      <tr class="bg-card">
                        <th class="text-left p-3 border border-border font-semibold text-primary" colspan="2">Key Product Features</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $features = [
                          ['Formulation', 'Wolverine (BPC-157 + TB-500)'],
                          ['Total Peptide Content', '20mg'],
                          ['BPC-157 Purity', '98.5% (HPLC)'],
                          ['TB-500 Purity', '99.2% (HPLC)'],
                          ['Format', 'Peptide pen kit'],
                          ['Testing', 'Independent HPLC analysis'],
                          ['Documentation', 'Batch-specific Certificate of Analysis (COA)'],
                          ['Application', 'Laboratory research only'],
                          ['Dispatch', 'UK'],
                        ];
                      @endphp
                      @foreach($features as $i => $row)
                        <tr class="{{ $i % 2 === 1 ? 'bg-card' : '' }}">
                          <td class="p-3 border border-border text-muted-foreground font-medium w-1/3">{{ $row[0] }}</td>
                          <td class="p-3 border border-border text-muted-foreground">{{ $row[1] }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </section>

              <!--  Precision-Oriented Research Format  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Precision-Oriented Research Format</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">In laboratory environments, experimental consistency can be just as important as compound identity and purity. A pen-style research device provides a defined mechanical delivery format that can help researchers investigate dose-response relationships, delivery consistency and repeatability between experimental conditions without relying exclusively on conventional manual transfer techniques.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-2">This makes peptide pen kits potentially interesting for research workflows involving:</p>
                <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1">
                  <li>Controlled-volume experimental studies</li>
                  <li>Dose-response investigations</li>
                  <li>Comparative peptide research</li>
                  <li>Repeated laboratory measurements</li>
                  <li>Formulation and delivery-system evaluation</li>
                  <li>Analytical method development</li>
                  <li>Controlled sample handling</li>
                  <li>Small-scale in-vitro or ex-vivo experimental protocols</li>
                </ul>
              </section>

              <!--  Why Pen-Based Research Formats Are Interesting  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Pen-Based Research Formats Are Interesting</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">Peptide research increasingly involves experiments where precision, reproducibility and controlled sample handling are important variables. A pen-format system provides an interesting research platform because the delivery mechanism itself can be evaluated alongside the underlying peptide formulation.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">For researchers, this creates an opportunity to investigate factors including delivery consistency, formulation stability, mechanical repeatability and controlled-volume experimental handling.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">The pen format should therefore be considered a research delivery configuration, rather than simply an alternative presentation of a conventional peptide vial.</p>
              </section>

              <!--  Two Peptides, One Research Configuration  -->
              <section>
                <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Wolverine: Two Peptides, One Research Configuration</h2>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3">The Wolverine formulation contains two chemically distinct peptides.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3"><strong class="text-primary">BPC-157</strong> is a synthetic pentadecapeptide that has predominantly been investigated in preclinical research involving vascular signalling, connective tissue and gastrointestinal models.</p>
                <p class="text-sm text-muted-foreground leading-relaxed mb-3"><strong class="text-primary">TB-500</strong> is a synthetic peptide fragment associated with the actin-binding region of thymosin beta-4. Research surrounding the underlying thymosin beta-4 biology has investigated cell migration, cytoskeletal organisation and tissue-remodelling pathways.</p>
                <p class="text-sm text-muted-foreground leading-relaxed">Importantly, the scientific literature on the individual peptides should not be interpreted as evidence that the specific Wolverine combination or pen format produces an equivalent biological effect. The combination itself remains an area of investigation, and controlled research should distinguish between findings relating to individual components and findings relating to the combined formulation.</p>
              </section>

              <!--  Research-Use Disclaimer  -->
              <div class="flex items-start gap-3 p-4 border border-border text-sm" style="background-color: #fff8e1">
                <i data-lucide="flask-conical" class="w-5 h-5 shrink-0 mt-0.5 text-accent"></i>
                <div class="flex flex-col gap-2 text-muted-foreground">
                  <p><strong class="text-accent">Research-Use Disclaimer</strong></p>
                  <p>For laboratory research use only. Not for human or veterinary use.</p>
                  <p>Research-Chem.uk peptide pen kits are supplied strictly for laboratory and analytical research. They are not intended for human or veterinary administration.</p>
                  <p>Researchers should establish their own validated experimental protocols, appropriate controls and analytical endpoints according to the requirements of their laboratory or institution.</p>
                  <p>For laboratories interested in precision-oriented peptide research, controlled delivery systems and repeatable sample handling, the Wolverine peptide pen represents an alternative research format that combines a defined delivery mechanism with independently analysed peptide components.</p>
                  <p><strong class="text-accent">For laboratory research only. Not for human or veterinary use.</strong></p>
                </div>
              </div>

            </div>