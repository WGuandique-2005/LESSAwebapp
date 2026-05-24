<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificado LESSA</title>
    <style>
        /* ── Reset & Page Setup ── */
        @page {
            margin: 0;
            size: A4 landscape;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            width: 100%;
            height: 100%;
            position: relative;
            color: #1a1a2e;
        }

        /* ── Main Certificate Container ── */
        .certificate-wrapper {
            width: 100%;
            height: 100%;
            padding: 0;
            position: relative;
            background: #ffffff;
        }

        /* ── Decorative Border Frame ── */
        .outer-border {
            position: absolute;
            top: 12px;
            left: 12px;
            right: 12px;
            bottom: 12px;
            border: 3px solid #1e3a5f;
            border-radius: 8px;
        }

        .inner-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 1px solid #b8860b;
        }

        /* ── Corner Ornaments ── */
        .corner-ornament {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 2px solid #b8860b;
        }

        .corner-top-left {
            top: 25px;
            left: 25px;
            border-right: none;
            border-bottom: none;
        }

        .corner-top-right {
            top: 25px;
            right: 25px;
            border-left: none;
            border-bottom: none;
        }

        .corner-bottom-left {
            bottom: 25px;
            left: 25px;
            border-right: none;
            border-top: none;
        }

        .corner-bottom-right {
            bottom: 25px;
            right: 25px;
            border-left: none;
            border-top: none;
        }

        /* ── Content Area ── */
        .content {
            position: relative;
            padding: 35px 60px 30px;
            text-align: center;
            z-index: 1;
        }

        /* ── Header Logos ── */
        .logos-header {
            width: 100%;
            margin-bottom: 10px;
        }

        .logos-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .logos-header td {
            text-align: center;
            vertical-align: middle;
            padding: 0 15px;
        }

        .logo-img {
            height: 70px;
            max-width: 150px;
            object-fit: contain;
        }

        .logo-center {
            height: 80px;
            max-width: 180px;
        }

        /* ── Top Decorative Line ── */
        .decorative-line {
            width: 80%;
            margin: 8px auto;
            height: 2px;
            background: linear-gradient(90deg, transparent, #b8860b, #1e3a5f, #b8860b, transparent);
        }

        .decorative-line-thin {
            width: 60%;
            margin: 4px auto;
            height: 1px;
            background: linear-gradient(90deg, transparent, #b8860b, transparent);
        }

        /* ── Institutional Header ── */
        .institution-name {
            font-size: 11px;
            color: #555;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 6px;
            font-weight: normal;
        }

        /* ── Certificate Title ── */
        .certificate-title {
            font-size: 36px;
            font-weight: bold;
            color: #1e3a5f;
            text-transform: uppercase;
            letter-spacing: 6px;
            margin: 12px 0 4px;
            line-height: 1.2;
        }

        .certificate-subtitle {
            font-size: 14px;
            color: #b8860b;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 14px;
            font-weight: normal;
        }

        /* ── Body Text ── */
        .otorga-text {
            font-size: 13px;
            color: #555;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        /* ── Recipient Name ── */
        .recipient-name {
            font-size: 32px;
            font-weight: bold;
            color: #1e3a5f;
            padding: 6px 0;
            margin: 4px auto;
            border-bottom: 2px solid #b8860b;
            display: inline-block;
            min-width: 400px;
            letter-spacing: 1px;
        }

        /* ── Description ── */
        .description {
            font-size: 12px;
            color: #444;
            line-height: 1.7;
            max-width: 650px;
            margin: 14px auto;
        }

        .course-name {
            font-weight: bold;
            color: #1e3a5f;
            font-size: 13px;
        }

        /* ── Date ── */
        .date-text {
            font-size: 11px;
            color: #777;
            margin-top: 8px;
            font-style: italic;
        }

        /* ── Bottom Signature Area ── */
        .signatures {
            width: 100%;
            margin-top: 18px;
        }

        .signatures table {
            width: 100%;
            border-collapse: collapse;
        }

        .signatures td {
            text-align: center;
            vertical-align: bottom;
            width: 33.33%;
            padding: 0 20px;
        }

        .signature-line {
            width: 180px;
            height: 1px;
            background: #333;
            margin: 0 auto 6px;
        }

        .signature-label {
            font-size: 10px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .signature-org {
            font-size: 9px;
            color: #888;
            margin-top: 2px;
        }

        /* ── Certificate ID ── */
        .certificate-id {
            font-size: 8px;
            color: #aaa;
            margin-top: 10px;
            letter-spacing: 1px;
        }

        /* ── Watermark-like Background Text ── */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 100px;
            color: rgba(30, 58, 95, 0.03);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 20px;
            z-index: 0;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        <!-- Decorative Borders -->
        <div class="outer-border"></div>
        <div class="inner-border"></div>

        <!-- Corner Ornaments -->
        <div class="corner-ornament corner-top-left"></div>
        <div class="corner-ornament corner-top-right"></div>
        <div class="corner-ornament corner-bottom-left"></div>
        <div class="corner-ornament corner-bottom-right"></div>

        <!-- Watermark -->
        <div class="watermark">LESSA</div>

        <!-- Main Content -->
        <div class="content">
            <!-- Logos Header -->
            <div class="logos-header">
                <table>
                    <tr>
                        <td>
                            @if($ugbLogo)
                                <img src="{{ $ugbLogo }}" class="logo-img" alt="UGB">
                            @endif
                        </td>
                        <td>
                            @if($lessaLogo)
                                <img src="{{ $lessaLogo }}" class="logo-img logo-center" alt="LESSA">
                            @endif
                        </td>
                        <td>
                            @if($minedLogo)
                                <img src="{{ $minedLogo }}" class="logo-img" alt="MINED">
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Institution -->
            <p class="institution-name">Universidad Gerardo Barrios &bull; Ministerio de Educación</p>

            <!-- Decorative Lines -->
            <div class="decorative-line"></div>
            <div class="decorative-line-thin"></div>

            <!-- Title -->
            <h1 class="certificate-title">Certificado</h1>
            <p class="certificate-subtitle">de Aprobación</p>

            <!-- Body -->
            <p class="otorga-text">Se otorga el presente certificado a:</p>

            <!-- Recipient -->
            <div class="recipient-name">{{ $nombreUsuario }}</div>

            <!-- Description -->
            <p class="description">
                Por haber completado satisfactoriamente el curso
                <span class="course-name">"Lengua de Señas Salvadoreña (LESSA)"</span>,
                demostrando dominio en las lecciones de Abecedario, Números, Saludos y Salud,
                en la plataforma educativa LESSA.
            </p>

            <!-- Date -->
            <p class="date-text">Emitido el {{ $fechaCompletado }}</p>

            <!-- Decorative Line -->
            <div class="decorative-line-thin" style="margin-top: 12px;"></div>

            <!-- Signatures -->
            <div class="signatures">
                <table>
                    <tr>
                        <td>
                            <div class="signature-line"></div>
                            <div class="signature-label">Plataforma LESSA</div>
                            <div class="signature-org">Equipo de Desarrollo</div>
                        </td>
                        <td>
                            <div class="signature-line"></div>
                            <div class="signature-label">Universidad Gerardo Barrios</div>
                            <div class="signature-org">Institución Patrocinadora</div>
                        </td>
                        <td>
                            <div class="signature-line"></div>
                            <div class="signature-label">MINED</div>
                            <div class="signature-org">Institución que Avala</div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Certificate ID -->
            <p class="certificate-id">
                ID: LESSA-{{ str_pad(auth()->id() ?? 0, 5, '0', STR_PAD_LEFT) }}-{{ date('Ymd') }}
            </p>
        </div>
    </div>
</body>
</html>
