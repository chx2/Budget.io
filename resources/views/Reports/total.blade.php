<!DOCTYPE html>
<html>
<head>
    <title>View Budget Report</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</head>
<body style="font-family: system-ui,sans-serif">
    <h1 style="text-align: center">Budget Report</h1>
    <h2 style="text-align: center">{{ $start }} - {{ $end }}</h2>
    <hr/>

    <h3>Incomes</h3>
    <table style="width: 100%">
        <tr>
            <th style="text-align: left">Source</th>
            <th style="text-align: center">Notes</th>
            <th style="text-align: right">Amount</th>
        </tr>
        @foreach($incomes as $income)
            <tr>
                <td style="width: 20%">{{ $income->source }}</td>
                <td style="width: 50%;text-align: center">{{ $income->notes }}</td>
                <td style="width: 30%;text-align: right">{{ number_format($income->amount, 2) }}</td>
            </tr>
        @endforeach
    </table>
    <hr/>

    <h3>Expenses</h3>
    <table style="width: 100%">
        <tr>
            <th style="text-align: left">Source</th>
            <th style="text-align: center">Notes</th>
            <th style="text-align: right">Amount</th>
        </tr>
        @foreach($expenses as $expense)
            <tr>
                <td style="width: 20%">{{ $expense->source }}</td>
                <td style="width: 50%;text-align: center">{{ $expense->notes }}</td>
                <td style="width: 30%;text-align: right">{{ number_format($expense->amount, 2) }}</td>
            </tr>
        @endforeach
    </table>
    <hr/>

    <h4 style="text-align: right">Totals</h4>
    <p style="text-align: right">{{ $gain }}</p>
    <p style="text-align: right">- {{ $loss }}</p>
    <hr style="width: 10%;text-align: right"/>
    <p style="text-align: right;font-weight: bold">{{ number_format($gain - $loss, 2) }}</p>
</body>
</html>
