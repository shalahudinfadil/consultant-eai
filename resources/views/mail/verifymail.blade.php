<!doctype html>
<html>
<head>
    {{-- @php($total = 0) --}}
    <meta charset="utf-8">
    <title>Metrasys - Verify Email</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
    <script src="/js/email.js"></script>
    <script src="/js/jquery-3.2.1.min.js"></script>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="3">

                <table>
                    <tr>
                        <td class="title">

                        </td>

                        <td align="justify">
                            <br>
                            <h1>Metrasys Ticket Helpdesk</h1>
                        </td>

                        <td align="right">
                            {{-- Invoice # : {{$data['transaction_id']}}
                            <br>
                            Issued : {{ date('Y-m-d H:i:s') }}
                            <br>
                            E-mail : {{Auth::user()->email}} --}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            <div><b><font size=/"48"/>Hello {{$data['name']}}!</font></b></div>
                            <div>
                              <b>Please verify your email ({{$data['email']}}) by clicking the following link : </b>
                              <br>
                              {{$data['url']}}
                            </div>
                        </td>

                        <td align="right">
                            {{-- {{Auth::user()->address}}
                            <br>
                            {{Auth::user()->phone_num}} --}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        {{-- <tr class="heading">
            <td>
                Payment Method
            </td>
            <td></td>
            <td>
                Total Items
            </td>
        </tr>

        <tr class="details">
            <td>
                Balance
            </td>
            <td></td>
            <td>
                {{-- {{$data['counts']}} --}}
            </td>
        </tr>

        {{-- <tr class="heading">
            <td>
                Items
            </td>

            <td>
                Price
            </td>

            <td>
                Sub Total
            </td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td>
                <hr>
                <b>Total: Rp {{$total}}</b>
            </td>
        </tr>
    </table> --}}
    <br>
    <div><center>This is auto-generated email. Do not reply.</div>
</div>
</body>
</html>
