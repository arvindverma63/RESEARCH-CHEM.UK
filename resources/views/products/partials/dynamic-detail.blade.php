<div class="mt-12 border-t border-border pt-10 flex flex-col gap-10">

  <!-- Product Overview -->
  <section>
    <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Product Overview</h2>
    
    @php
      $overviewText = !empty($product['chemDesc']) ? $product['chemDesc'] : (!empty($product['desc']) ? $product['desc'] : (!empty($product['description']) ? $product['description'] : ''));
      // Clean up overview paragraphs if multiline
      $rawParagraphs = preg_split('/(\r\n|\n|\r){2,}/', trim($overviewText));
      $paragraphs = [];
      foreach ($rawParagraphs as $rp) {
          $trimmed = trim($rp);
          if (!empty($trimmed)) {
              $paragraphs[] = $trimmed;
          }
      }
      if (empty($paragraphs) && !empty($overviewText)) {
          $lines = explode("\n", trim($overviewText));
          foreach ($lines as $ln) {
              $trimmed = trim($ln);
              if (!empty($trimmed)) {
                  $paragraphs[] = $trimmed;
              }
          }
      }
    @endphp

    @if(!empty($paragraphs))
      @foreach($paragraphs as $p)
        <p class="text-sm text-muted-foreground leading-relaxed mb-3">{{ $p }}</p>
      @endforeach
    @else
      <p class="text-sm text-muted-foreground leading-relaxed mb-3">
        {{ $product['name'] }} is supplied as a high-purity laboratory research compound intended strictly for in-vitro scientific investigation, analytical chromatography, and experimental laboratory models.
      </p>
      <p class="text-sm text-muted-foreground leading-relaxed mb-4">
        Manufactured under rigorous synthetic and analytical standards, this material is documented with batch-specific analytical testing ensuring purity and traceability for qualified research laboratories.
      </p>
    @endif

    <!-- Key Product Features Table -->
    <div class="overflow-x-auto mt-4">
      <table class="w-full text-sm border-collapse">
        <thead>
          <tr class="bg-card">
            <th class="text-left p-3 border border-border font-semibold text-primary" colspan="2">Key Product Features</th>
          </tr>
        </thead>
        <tbody>
          @php
            $doseOrQty = !empty($product['dose']) ? $product['dose'] : (!empty($product['volume']) ? $product['volume'] : 'Standard Research Unit');
            $purity = !empty($product['purity']) ? $product['purity'] : '≥98.0% (HPLC verified)';
            if (!str_contains($purity, 'HPLC') && !str_contains($purity, 'hplc')) {
                $purity .= ' (HPLC verified)';
            }
            $vialSize = !empty($product['volume']) ? $product['volume'] : (!empty($product['vialSize']) ? $product['vialSize'] : '3ml');

            $features = [
                ['Product', $product['name']],
                ['Vial Quantity', $doseOrQty],
                ['Purity Threshold', $purity],
            ];

            if (!empty($product['molecularFormula']) || !empty($product['formula'])) {
                $features[] = ['Molecular Formula', $product['molecularFormula'] ?? $product['formula']];
            }
            if (!empty($product['molecularWeight'])) {
                $features[] = ['Molecular Weight', $product['molecularWeight']];
            }
            if (!empty($product['cas'])) {
                $features[] = ['CAS Number', $product['cas']];
            }

            $physicalForm = !empty($product['appearance']) 
                ? $product['appearance'] 
                : (($product['category'] ?? '') === 'sarms' ? 'Liquid solution' : 'Lyophilised white powder');
            $features[] = ['Physical Form', $physicalForm];

            $features[] = ['Documentation', 'Batch-specific Certificate of Analysis (COA)'];
            $features[] = ['Intended Application', 'In-vitro scientific laboratory research only'];
            $features[] = ['Origin / Dispatch', 'United Kingdom (Dispatched in 2–3 working days)'];
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

  <!-- Product Specifications Table -->
  <section>
    <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">{{ $product['name'] }} Product Specifications</h2>
    
    @if(!empty($product['sequence']))
      <p class="text-sm text-muted-foreground leading-relaxed mb-2 font-medium">Primary Sequence:</p>
      <p class="text-sm text-muted-foreground leading-relaxed mb-4 font-mono bg-card border border-border px-3 py-2 rounded break-all">
        {{ $product['sequence'] }}
      </p>
    @endif

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
            $specs = [
                ['Product Name', $product['name']],
            ];
            if (!empty($product['cas'])) {
                $specs[] = ['CAS Number', $product['cas']];
            }
            if (!empty($product['molecularFormula']) || !empty($product['formula'])) {
                $specs[] = ['Molecular Formula', $product['molecularFormula'] ?? $product['formula']];
            }
            if (!empty($product['molecularWeight'])) {
                $specs[] = ['Molecular Weight', $product['molecularWeight']];
            }
            $specs[] = ['Stated Purity', $purity];
            if (!empty($product['sequence'])) {
                $specs[] = ['Peptide Sequence', $product['sequence']];
            }
            if (!empty($product['solvent'])) {
                $specs[] = ['Solvent Matrix', $product['solvent']];
            }
            if (!empty($product['appearance'])) {
                $specs[] = ['Appearance', $product['appearance']];
            }
            if (!empty($product['storage'])) {
                $specs[] = ['Storage Specification', $product['storage']];
            }
            $specs[] = ['Testing Method', 'High-Performance Liquid Chromatography (HPLC) & Mass Spectrometry (MS)'];
            $specs[] = ['Analytical Documentation', 'Batch-specific Certificate of Analysis (COA)'];
            $specs[] = ['Intended Application', 'Laboratory research use only (in-vitro)'];
          @endphp

          @foreach($specs as $i => $row)
            <tr class="{{ $i % 2 === 1 ? 'bg-card' : '' }}">
              <td class="p-3 border border-border text-muted-foreground font-medium w-1/3">{{ $row[0] }}</td>
              <td class="p-3 border border-border text-muted-foreground">{{ $row[1] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

  <!-- Quality and Purity Standards -->
  <section>
    <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Quality and Analytical Standards</h2>
    <p class="text-sm text-muted-foreground leading-relaxed mb-3">
      At Research-Chem.uk, analytical quality, purity verification, and batch traceability are paramount across our entire research catalogue.
    </p>
    <p class="text-sm text-muted-foreground leading-relaxed mb-3">
      Every batch of <strong>{{ $product['name'] }}</strong> undergoes rigorous analytical evaluation via High-Performance Liquid Chromatography (HPLC) and Mass Spectrometry (MS) to verify molecular mass, peptide sequence integrity, and chemical purity. Batch-specific Certificates of Analysis (COA) are provided for qualified laboratory record-keeping and audit compliance.
    </p>
    <p class="text-sm text-muted-foreground leading-relaxed">
      Our quality-assurance framework guarantees reproducible standards for scientific investigation, analytical assay development, and academic research.
    </p>
  </section>

  <!-- Laboratory Research Applications -->
  <section>
    <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Laboratory Research Applications</h2>
    <p class="text-sm text-muted-foreground leading-relaxed mb-3">
      {{ $product['name'] }} is supplied exclusively as a reference compound for controlled in-vitro scientific research. Documented experimental applications include:
    </p>
    <ul class="text-sm text-muted-foreground leading-relaxed list-disc list-inside flex flex-col gap-1 mb-3">
      <li>In-vitro cellular signalling and biochemical pathway investigations</li>
      <li>Analytical assay validation and high-performance chromatographic reference standardisation</li>
      <li>Receptor binding affinity and enzyme kinetic profiling</li>
      <li>Molecular interaction and quantitative cellular response studies</li>
    </ul>
    <p class="text-sm text-muted-foreground leading-relaxed">
      Strictly not for clinical diagnostic procedures, therapeutic administration, or any form of in-vivo human or veterinary testing.
    </p>
  </section>

  <!-- Why Choose Research-Chem.uk -->
  <section>
    <h2 class="text-xl font-bold mb-4 text-primary" style="font-family: var(--font-heading)">Why Choose Research-Chem.uk?</h2>
    <div class="flex flex-col gap-4">
      @php
        $whyChooseItems = [
            ['HPLC-Verified Purity', 'Every research compound is verified with chromatographic analysis and supplied with batch-specific purity documentation.'],
            ['Batch Traceability', 'Comprehensive documentation and Certificate of Analysis (COA) reports accompany research lots for full experimental reproducibility.'],
            ['UK Domestic Dispatch', 'Dispatched directly from within the United Kingdom for reliable, prompt domestic transit in temperature-controlled packaging.'],
            ['Research-Only Standard', 'Dedicated strictly to qualified academic, clinical, and industrial research environments.'],
            ['Transparent Specifications', 'Full disclosure of molecular weight, CAS registry, purity threshold, and chemical storage recommendations.'],
        ];
      @endphp
      @foreach($whyChooseItems as $item)
        <div>
          <p class="text-sm font-semibold text-primary mb-1">{{ $item[0] }}</p>
          <p class="text-sm text-muted-foreground leading-relaxed">{{ $item[1] }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <!-- Research-Use Disclaimer -->
  <div class="flex items-start gap-3 p-4 border border-border text-sm rounded-lg" style="background-color: #fff8e1">
    <i data-lucide="flask-conical" class="w-5 h-5 shrink-0 mt-0.5 text-accent"></i>
    <div class="flex flex-col gap-2 text-muted-foreground">
      <p><strong class="text-accent">Research-Use Disclaimer</strong></p>
      <p><strong>For laboratory research use only. Strictly not for human or veterinary administration.</strong></p>
      <p>{{ $product['name'] }} supplied by Research-Chem.uk is intended exclusively for in-vitro scientific study, analytical testing, and laboratory evaluation.</p>
      <p>This compound is not a medication, drug, medical device, dietary supplement, or cosmetic. It is not approved by regulatory authorities for the diagnosis, treatment, cure, mitigation, or prevention of any disease or condition in humans or animals.</p>
      <p>Purchasers are solely responsible for ensuring handling, storage, and laboratory utilization comply with all relevant UK statutory provisions, COSHH assessments, and institutional safety regulations.</p>
    </div>
  </div>

</div>

