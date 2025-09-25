<style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 30px;
        }
        h2, h3 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #e9ecef;
            color: #495057;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        hr {
            margin: 20px 0;
            border: none;
            border-top: 2px solid #dee2e6;
        }
        p {
            margin: 5px 0;
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            body {
                margin: 10px;
            }
            table, thead, tbody, th, td, tr {
                display: block;
                width: 100%;
            }
            thead {
                display: none;
            }
            tr {
                margin-bottom: 15px;
                background: #fff !important;
                border-radius: 6px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            }
            td {
                border: none;
                position: relative;
                padding-left: 50%;
                min-height: 40px;
            }
            td:before {
                position: absolute;
                left: 10px;
                top: 10px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #495057;
            }
            td:nth-of-type(1):before { content: "Examen"; }
            td:nth-of-type(2):before { content: "Resultado"; }
            td:nth-of-type(3):before { content: "Rango de referencia"; }
            td:nth-of-type(4):before { content: "Unidad"; }
        }
    </style>

    @php
        use Illuminate\Support\Str;

        $numero_orden = rand(10000, 99999);
        $clave = $clave ?? strtoupper(Str::random(8));
        $nombres = ['Juan Pérez', 'Ana Gómez', 'Luis Torres', 'María López', 'Carlos Ruiz'];
        $nombre_paciente = $nombre_paciente ?? $nombres[array_rand($nombres)];
        $edad = $edad ?? rand(18, 80);
        $sexo = $sexo ?? (rand(0, 1) ? 'Masculino' : 'Femenino');
        $medicos = ['Dr. Martínez', 'Dra. Sánchez', 'Dr. Ramírez', 'Dra. Castillo'];
        $medico = $medico ?? $medicos[array_rand($medicos)];
        $tipos_muestra = ['Sangre', 'Orina', 'Saliva', 'Plasma'];
        $tipo_muestra = $tipo_muestra ?? $tipos_muestra[array_rand($tipos_muestra)];

        $pruebas = [
            ['Glucosa', 70, 110, 'mg/dL', 'Normalidad glucosa', 'Valores normales de glucosa en ayunas', 'Fuera de rango puede indicar diabetes o hipoglucemia'],
            ['Colesterol', 150, 240, 'mg/dL', 'Colesterol total', 'Valores normales de colesterol', 'Fuera de rango puede indicar riesgo cardiovascular'],
            ['Hemoglobina', 12, 17, 'g/dL', 'Hemoglobina', 'Valores normales en adultos', 'Fuera de rango puede indicar anemia o policitemia'],
            ['Creatinina', 0.7, 1.3, 'mg/dL', 'Creatinina', 'Función renal', 'Fuera de rango puede indicar daño renal'],
            ['Triglicéridos', 50, 150, 'mg/dL', 'Triglicéridos', 'Lípidos en sangre', 'Fuera de rango puede indicar riesgo cardiovascular'],
            ['Ácido úrico', 3.5, 7.2, 'mg/dL', 'Ácido úrico', 'Metabolismo purinas', 'Fuera de rango puede indicar gota'],
            ['Calcio', 8.5, 10.5, 'mg/dL', 'Calcio', 'Mineral óseo', 'Fuera de rango puede indicar problemas óseos'],
            ['Sodio', 135, 145, 'mmol/L', 'Sodio', 'Electrolito', 'Fuera de rango puede indicar deshidratación'],
            ['Potasio', 3.5, 5.1, 'mmol/L', 'Potasio', 'Electrolito', 'Fuera de rango puede afectar el corazón'],
            ['Leucocitos', 4000, 11000, '/uL', 'Leucocitos', 'Glóbulos blancos', 'Fuera de rango puede indicar infección'],
            ['Plaquetas', 150000, 450000, '/uL', 'Plaquetas', 'Coagulación', 'Fuera de rango puede indicar sangrado'],
            ['Eritrocitos', 4.5, 6.0, 'mill/uL', 'Eritrocitos', 'Glóbulos rojos', 'Fuera de rango puede indicar anemia'],
            ['Bilirrubina', 0.2, 1.2, 'mg/dL', 'Bilirrubina', 'Función hepática', 'Fuera de rango puede indicar ictericia'],
            ['Transaminasas', 10, 40, 'U/L', 'Transaminasas', 'Enzimas hepáticas', 'Fuera de rango puede indicar daño hepático'],
            ['Fosfatasa alcalina', 44, 147, 'U/L', 'Fosfatasa alcalina', 'Enzima ósea/hepática', 'Fuera de rango puede indicar enfermedad ósea'],
            ['Proteínas totales', 6.0, 8.3, 'g/dL', 'Proteínas totales', 'Estado nutricional', 'Fuera de rango puede indicar desnutrición'],
            ['Albumina', 3.5, 5.0, 'g/dL', 'Albumina', 'Proteína plasmática', 'Fuera de rango puede indicar enfermedad hepática'],
            ['Globulina', 2.3, 3.5, 'g/dL', 'Globulina', 'Proteína plasmática', 'Fuera de rango puede indicar infección'],
            ['Hierro', 60, 170, 'mcg/dL', 'Hierro', 'Mineral esencial', 'Fuera de rango puede indicar anemia'],
            ['TSH', 0.4, 4.0, 'uIU/mL', 'TSH', 'Función tiroidea', 'Fuera de rango puede indicar hipotiroidismo o hipertiroidismo'],
        ];

        $examenes = [];
        foreach ($pruebas as $p) {
            $valor = is_float($p[1]) ? round(rand($p[1]*10, $p[2]*10)/10, 1) : rand($p[1], $p[2]);
            // 20% probabilidad de estar fuera de rango
            if (rand(1, 5) == 1) {
                $valor = $valor < $p[1] ? $p[1] - rand(1, 10) : $p[2] + rand(1, 10);
            }
            $examenes[] = [
                'nombre' => $p[0],
                'resultado' => $valor,
                'rango' => "{$p[1]} - {$p[2]} {$p[3]}<br>{$p[4]}<br>{$p[5]}<br>{$p[6]}",
                'unidad' => $p[3],
                'min' => $p[1],
                'max' => $p[2],
            ];
        }
    @endphp

   
    <hr>
    <h3>Resultado de Examen de Laboratorio</h3>
    <p><strong>Orden:</strong> {{ $numero_orden }}</p>
    <p><strong>Fecha:</strong> {{ date('d/m/Y') }}</p>
    <p><strong>Nombre del paciente:</strong> {{ $nombre_paciente }}</p>
    <p><strong>Edad:</strong> {{ $edad }}</p>
    <p><strong>Sexo:</strong> {{ $sexo }}</p>
    <p><strong>Médico solicitante:</strong> {{ $medico }}</p>
    <p><strong>Tipo de muestra:</strong> {{ $tipo_muestra }}</p>
    <table>
        <thead>
            <tr>
                <th>Examen</th>
                <th>Resultado</th>
                <th>Rango de referencia</th>
                <th>Unidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($examenes as $examen)
            @php
                $fuera_rango = $examen['resultado'] < $examen['min'] || $examen['resultado'] > $examen['max'];
            @endphp
            <tr>
                <td>{{ $examen['nombre'] }}</td>
                <td>
                    {{ $examen['resultado'] }}@if($fuera_rango)<strong style="color:red">*</strong>@endif
                </td>
                <td>{!! $examen['rango'] !!}</td>
                <td>{{ $examen['unidad'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div style="text-align:center;">
        <button onclick="window.print()" style="margin-top:20px;padding:10px 20px;background:#2c3e50;color:#fff;border:none;border-radius:4px;cursor:pointer;">
            Descargar resultado
        </button>
    </div>