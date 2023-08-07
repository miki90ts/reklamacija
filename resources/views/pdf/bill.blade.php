<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Spisak računa PDF</title>
    <style>
        *{ 
            font-family: DejaVu Sans; font-size: 12px;
        }
       
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            padding: 0.75rem;
            text-align: left;
            background-color: #f7fafc; 
            border-bottom: 1px solid #e2e8f0; 
        }

        td {
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0; 
        }

    
        tr:nth-child(even) {
            background-color: #f7fafc; 
        }

        .text-center {
            text-align:center
        }
    </style>
</head>
<body>    
    <h1 class="text-center">Spisak računa</h1>    
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Radnja
                </th>
                <th>
                    Proizvod
                </th>
                <th>
                    Brend
                </th>
                <th>
                    Kategorija
                </th>
                <th>
                    Ističe garancija
                </th>
                <th>
                    Cena
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $bill)
                <tr>
                    <td>
                        {{ $loop->index + 1 }}.
                    </td>
                    <td>
                        {{ $bill['store']['title'] }}
                    </td>
                    <td>
                        {{ $bill['product']['title'] }}
                    </td>
                    <td>
                        {{ $bill['product']['brand']['title'] }}
                    </td>
                    <td>
                        {{ $bill['product']['brand']['category']['title'] }}
                    </td>
                    <td>
                        {{ $bill['purchased_at'] }}
                    </td>
                    <td>
                        {{ $bill['price'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>