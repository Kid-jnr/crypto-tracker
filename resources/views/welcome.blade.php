<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crypto Price Tracker</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!--- Datatable -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Rubik+Iso&display=swap" rel="stylesheet">
</head>

<style>
    body{
        font-family: 'Josefin Sans', sans-serif;
    }
</style>

<body>
    <div class="container-md">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h1 class="text-center " style="font-family: 'Rubik Iso', cursive; font-size: 4em; margin-top: 16px">Norman Crypto Price Tracker  </h1>
            </div>
            <div class=" col-sm-12 col-md-10 col-lg-10 mb-7">

                    <div class="col-6 mb-7" style="margin-top: 50px">
                      <label class="" for="inlineFormSelectPref">Select Period</label>
                      <select class="form-control select-input placeholder-active active" id="selectPeriod" name="period">
                        <option value="day">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="week">A Week</option>
                        <option value="month">A Month</option>
                        <option value="year">A Year</option>
                      </select>
                    </div>

                <table class="table align-middle mb-0 bg-white" id="myTable">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Period</th>
                            <th>Average Price</th>
                        </tr>
                    </thead>
                    <tbody id="injectable">
                        @foreach ($prices as $item)
                        <tr>

                            <td>
                                <p class="fw-normal mb-1">{{$item->symbol}}</p>

                            </td>
                            <td>
                                <p class="text-muted mb-0">(1) {{$item->time_period}}</p>
                            </td>

                            <td>$ {{$item->average_price}}</td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
<!-- Datatable -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    // Select select input and attach a change event
    const mySelect = document.getElementById("selectPeriod");

    mySelect.addEventListener("change",async () => {
    const selectedOption = mySelect.options[mySelect.selectedIndex].value;
    mySelect.setAttribute("disabled", true);
    try {
        const url = "{{ route('sortedPrices', ':selectedOption') }}".replace(':selectedOption', selectedOption);
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        let response = await fetch(url,{method: "POST",headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': token }})
        const data = await response.json();
        let table = document.getElementById('injectable');
        table.innerHTML = '';

        data.forEach(element => {

            table.innerHTML +=
            `
            <tr>

                <td>
                    <p class="fw-normal mb-1">${ element.symbol}</p>

                </td>
                <td>
                    <p class="text-muted mb-0">(1) ${element.time_period}</p>
                </td>

                <td>$ ${element.average_price}</td>

                </tr>
            `
        });

        console.log(data)
        mySelect.removeAttribute("disabled");
    } catch (error) {

    }

    });
</script>

</html>
