<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{__('students.student_file')}} – {{ $student->full_name }}</title>
    <style type="text/css">
        /* Basis-Styles */
        * {
            box-sizing: border-box;
            font-family: Courier, monospace;
        }

        body {
            color: #222;
            font-size: 12pt;
            margin: 36px;
        }

        /* Kopfbereich */
        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .title {
            font-size: 20pt;
            font-weight: bold;
            margin: 8px 0 2px;
            color: #333;
        }

        .subtitle {
            font-size: 11pt;
            color: #666;
            margin: 0 0 16px;
        }

        /* Karte / Hauptcontainer */
        .card {
            border: 1px solid #bbb;
            border-radius: 6px;
            padding: 16px;
        }

        /* Tabelle */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            padding: 10px 12px;
            vertical-align: top;
            border-bottom: 1px solid #e1e1e1;
        }

        th {
            width: 30%;
            text-align: left;
            color: #555;
            font-weight: bold;
            background: #f7f7f7;
        }

        tr:last-child td,
        tr:last-child th {
            border-bottom: none;
        }

        /* Signaturblöcke */
        .signature-blocks {
            margin-top: 28px;
            display: table;
            width: 100%;
        }

        .signature {
            display: table-cell;
            width: 50%;
            padding-right: 12px;
        }

        .signature:last-child {
            padding-right: 0;
            padding-left: 12px;
        }

        .sig-line {
            margin-top: 42px;
            border-top: 1px solid #999;
            padding-top: 6px;
            text-align: center;
            color: #666;
            font-size: 10pt;
        }

        /* Helferklassen */
        .nowrap {
            white-space: nowrap;
        }
    </style>
</head>
<body>

{{-- Kopfbereich mit Wappen --}}
<div class="header">
    <div class="crest" style="margin-bottom: 0px">
        <img
            src="{{ public_path('images/hogwarts-crest.png') }}"
            alt="Hogwarts Crest"
            style="display:block; width:200px; height:auto; margin:0 auto;">
    </div>
    <div class="title">{{__('students.student_file')}}</div>
    <div class="subtitle">{{ $student->full_name }}</div>
</div>

<div class="card">
    <table>
        <tr>
            <th>{{__('students.name')}}</th>
            <td>{{ $student->full_name }}</td>
        </tr>
        <tr>
            <th>{{__('students.gender.label')}}</th>
            <td>{{ __('students.gender.' . $student->gender) }}</td>
        </tr>
        <tr>
            <th>{{__('students.birth_date')}}</th>
            <td class="nowrap">{{ $student->birthday?->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th>{{__('students.house')}}</th>
            <td>{{ $student->house->name ?? '–' }}</td>
        </tr>
        <tr>
            <th>{{__('students.blood_status.label')}}</th>
            <td>{{ __('students.blood_status.' . Str::lower($student->bloodStatus->short_name)) }}</td>
        </tr>
        <tr>
            <th>{{__('students.enrollment_date')}}</th>
            <td class="nowrap">{{ $student->enrollment_date?->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <th>{{__('students.diploma.label')}}</th>
            <td class="nowrap">{{ $student->graduation_date?->format('d.m.Y') ?? '-' }}</td>
        </tr>
        <tr>
            <th>{{__('students.diploma.degree')}}</th>
            <td>{{ $student->diploma ? __('students.diploma.' . Str::lower($student->diploma->short_name)) : '-'}}</td>
        </tr>
    </table>

    <div class="signature-blocks">
        <div class="signature"><div class="sig-line">{{__('students.sign')}} {{__('students.student')}}</div></div>
    </div>
</div>

</body>
</html>
