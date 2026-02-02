<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laporan Absensi Guru</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
			font-size: 11px;
			color: #333;
			line-height: 1.4;
		}
		
		.header {
			text-align: center;
			margin-bottom: 25px;
			padding-bottom: 15px;
			border-bottom: 3px solid #333;
		}
		
		.header h1 {
			font-size: 20px;
			font-weight: bold;
			margin-bottom: 5px;
			color: #1a1a1a;
		}
		
		.header h2 {
			font-size: 14px;
			font-weight: normal;
			color: #666;
		}
		
		.info-section {
			margin-bottom: 20px;
			padding: 10px;
			background-color: #f8f9fa;
			border-left: 4px solid #667eea;
		}
		
		.info-row {
			display: table;
			width: 100%;
			margin-bottom: 5px;
		}
		
		.info-label {
			display: table-cell;
			width: 120px;
			font-weight: bold;
			color: #555;
		}
		
		.info-value {
			display: table-cell;
			color: #333;
		}
		
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 15px;
			page-break-inside: auto;
		}
		
		thead {
			display: table-header-group;
		}
		
		tbody tr {
			page-break-inside: avoid;
			page-break-after: auto;
		}
		
		th {
			background-color: #667eea;
			color: white;
			padding: 10px 8px;
			text-align: left;
			font-weight: bold;
			border: 1px solid #555;
			font-size: 10px;
		}
		
		td {
			padding: 8px;
			border: 1px solid #ddd;
			text-align: left;
		}
		
		tbody tr:nth-child(even) {
			background-color: #f8f9fa;
		}
		
		tbody tr:hover {
			background-color: #e9ecef;
		}
		
		.status-hadir {
			color: #28a745;
			font-weight: bold;
		}
		
		.status-izin {
			color: #ffc107;
			font-weight: bold;
		}
		
		.status-sakit {
			color: #fd7e14;
			font-weight: bold;
		}
		
		.status-alpha {
			color: #dc3545;
			font-weight: bold;
		}
		
		.summary {
			margin-top: 20px;
			padding: 15px;
			background-color: #f8f9fa;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		
		.summary-title {
			font-weight: bold;
			font-size: 12px;
			margin-bottom: 10px;
			color: #333;
		}
		
		.summary-row {
			display: inline-block;
			margin-right: 20px;
			margin-bottom: 5px;
		}
		
		.footer {
			margin-top: 30px;
			padding-top: 15px;
			border-top: 1px solid #ddd;
			text-align: center;
			font-size: 9px;
			color: #666;
		}
		
		.page-break {
			page-break-before: always;
		}
	</style>
</head>
<body>
	<div class="header">
		<h1>LAPORAN ABSENSI GURU</h1>
		<h2>SMK Budi Luhur</h2>
	</div>
	
	<div class="info-section">
		<div class="info-row">
			<span class="info-label">Tanggal Laporan:</span>
			<span class="info-value">{{ \Carbon\Carbon::now()->format('d F Y') }}</span>
		</div>
		<div class="info-row">
			<span class="info-label">Total Data:</span>
			<span class="info-value">{{ $data->count() }} record</span>
		</div>
		<div class="info-row">
			<span class="info-label">Periode:</span>
			<span class="info-value">
				@if($data->count() > 0)
					{{ \Carbon\Carbon::parse($data->last()->tanggal)->format('d F Y') }} - {{ \Carbon\Carbon::parse($data->first()->tanggal)->format('d F Y') }}
				@else
					-
				@endif
			</span>
		</div>
	</div>
	
	<table>
		<thead>
			<tr>
				<th style="width: 5%;">No</th>
				<th style="width: 12%;">Tanggal</th>
				<th style="width: 25%;">Nama Guru</th>
				<th style="width: 15%;">NIP</th>
				<th style="width: 12%;">Status</th>
				<th style="width: 31%;">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($data as $index => $row)
				<tr>
					<td style="text-align: center;">{{ $index + 1 }}</td>
					<td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}</td>
					<td>{{ $row->guru?->nama ?? '-' }}</td>
					<td>{{ $row->guru?->nip ?? '-' }}</td>
					<td class="status-{{ $row->status }}">
						{{ strtoupper($row->status) }}
					</td>
					<td>{{ $row->keterangan ?? '-' }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="6" style="text-align: center; padding: 20px; color: #999;">
						Tidak ada data absensi
					</td>
				</tr>
			@endforelse
		</tbody>
	</table>
	
	@if($data->count() > 0)
		<div class="summary">
			<div class="summary-title">RINGKASAN STATUS</div>
			<div class="summary-row">
				<strong>Hadir:</strong> {{ $data->where('status', 'hadir')->count() }}
			</div>
			<div class="summary-row">
				<strong>Izin:</strong> {{ $data->where('status', 'izin')->count() }}
			</div>
			<div class="summary-row">
				<strong>Sakit:</strong> {{ $data->where('status', 'sakit')->count() }}
			</div>
			<div class="summary-row">
				<strong>Alpha:</strong> {{ $data->where('status', 'alpha')->count() }}
			</div>
		</div>
	@endif
	
	<div class="footer">
		<p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i:s') }} | Sistem Absensi SMK Budi Luhur</p>
	</div>
</body>
</html>

