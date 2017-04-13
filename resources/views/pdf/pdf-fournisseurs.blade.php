<html>
<head>
<title>Fournisseurs</title>
<style type="text/css">
    #page-wrap {
        width: 700px;
        margin: 0 auto;
    }
    .center-justified {
        text-align: justify;
        margin: 0 auto;
        width: 30em;
    }
    table.outline-table {
        border: 1px solid;
        border-spacing: 0;
    }
    tr.border-bottom td, td.border-bottom {
        border-bottom: 1px solid;
    }
    tr.border-top td, td.border-top {
        border-top: 1px solid;
    }
    tr.border-right td, td.border-right {
        border-right: 1px solid;
    }
    tr.border-right td:last-child {
        border-right: 0px;
    }
    tr.center td, td.center {
        text-align: center;
        vertical-align: text-top;
    }
    td.pad-left {
        padding-left: 5px;
    }
    tr.right-center td, td.right-center {
        text-align: right;
        padding-right: 50px;
    }
    tr.right td, td.right {
        text-align: right;
    }
    .grey {
        background:grey;
    }
</style>
</head>
<body>
    <div id="page-wrap">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="30%">
                        <img src="images/golfmaroc.png" > <!-- your logo here -->
                    </td>
                    <td width="70%">
                        <h1>Liste des Fournisseurs</h1><br>
                        <strong>Fait le :</strong> {{ date('d-M-Y') }}<br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>

            </tbody>
        </table>
        <p>&nbsp;</p>


        <table width="100%" class="outline-table">
            <tbody>
                <tr class="border-bottom border-right grey">
                    <td colspan="4"><center><strong>Liste des catégories</strong></td>
                </tr>
                <tr class="border-bottom border-right center">
                    <td width="5%"><strong> # </strong></td>
                    <td width="10%"><strong>Code</strong></td>
                    <td><strong>Libellé</strong></td>
                    <td width="20%"><strong>Telephone</strong></td>
                </tr>
                @foreach($data as $item)
                <tr class="border-right">
                  <td class="pad-left">{{ $loop->index+1 }}</td>
                  <td class="center">{{ $item->code }}</td>
                  <td class="center">{{ $item->libelle }}</td>
                  <td class="center">{{ $item->telephone }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <p>&nbsp;</p>

    </div>
</body>
</html>
