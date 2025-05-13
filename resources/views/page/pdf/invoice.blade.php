<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Penggajian</title>
</head>
<body>
    <h1>Penggajian</h1>
    <h5>Berikut rincian gaji anda :</h5>
    <p>Periode: {{ $paymentData->month }} {{ $paymentData->year }}</p>
    <p>Nama: {{ $paymentData->name }}</p>
    <p>NIP: {{ $paymentData->nip }}</p>
    <p>Posisi: {{ $paymentData->position }}</p>
    <p>Gaji: {{ $paymentData->salary }}</p>
</body>
</html>