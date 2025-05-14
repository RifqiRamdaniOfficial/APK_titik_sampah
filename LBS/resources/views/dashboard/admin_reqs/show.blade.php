
@extends('dashboard.layout.main')

@section('container')

@php
   if (isset($_POST["submit"])) {

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'target' => "085321208442",
        'message' => "Terimakasih sudah mengisi form.",
        'countryCode' => '62', //optional
    ),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Q4SUZSA2qu9Tj3B@nCxg' //change TOKEN to your actual token
    ),
));

$response = curl_exec($curl);

curl_close($curl);
} 
@endphp


    <div class="contaiener">
        <div class="row my-3 ">
            <div class="col-lg-8 ">
                <h1 class="mb-3">Reques area RW {{ $req->region_no }}</h1>
            </div>
        </div>
    </div>

    <?php if (isset($response)) {
        $result = json_decode($response, true);
        $alert = $result["status"] ? $result["detail"] : $result["reason"]; ?>
        <script>
            alert("<?= $alert ?>")
        </script>
    <?php }
    ?>

    <div style="width: 100%;max-width: 600px;margin: auto;border-radius: 10px;box-shadow: 0px 0px 10px -7px;padding: 20px;">
        <h2 style="
    text-align: center;
">Form</h2>
        <form action="/dashboard/admin_reqs" method="POST">
            @csrf
            <div style="
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
">
            <div style="
    display: flex;
    justify-content: end;
"><button type="submit" name="submit" style="
    background: lightseagreen;
    padding: 12px 48px;
    border: none;
    color: white;
    border-radius: 10px;
    cursor: pointer;
    margin: 20px 0;
">Submit</button></div>
        </form>
    </div>

@endsection