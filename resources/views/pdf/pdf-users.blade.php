<html>

<head>
    <title>Liste des Utilisateurs</title>
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

        tr.border-bottom td,
        td.border-bottom {
            border-bottom: 1px solid;
        }

        tr.border-top td,
        td.border-top {
            border-top: 1px solid;
        }

        tr.border-right td,
        td.border-right {
            border-right: 1px solid;
        }

        tr.border-right td:last-child {
            border-right: 0px;
        }

        tr.center td,
        td.center {
            text-align: center;
            vertical-align: text-top;
        }

        td.pad-left {
            padding-left: 5px;
        }

        tr.right-center td,
        td.right-center {
            text-align: right;
            padding-right: 50px;
        }

        tr.right td,
        td.right {
            text-align: right;
        }

        .grey {
            background: grey;
        }
    </style>
</head>

<body>
    <div id="page-wrap">
        <table width="100%">
            <thead>
                <tr>
                    <th width="30%">
                        <img src="images/golfmaroc.png">
                    </th>
                    <th width="70%">
                        <h1>Liste des Utilisateurs</h1><br>
                        <strong>Fait le :</strong> {{ date('d-M-Y') }}<br>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
            </thead>
        </table>

        <p>&nbsp;</p>

        <table width="100%" class="outline-table">
            <tbody>
                <tr class="border-bottom border-right grey">
                    <td colspan="6"><center><strong>Liste des Utilisateurs</strong></td>
                </tr>
                <tr class="border-bottom border-right center">
                  <td> #</td>
                  <td>Role</td>
                  <td>Nom</td>
                  <td>Prenom</td>
                  <td>Ville</td>
                  <td>Magasin</td>
                </tr>
                @foreach($data as $item)
                <tr class="border-right">
                  <td class="center">{{ $loop->index+1 }}</td>
                  <td class="pad-left">{{ getRoleName($item->id_role) }}</td>
                  <td class="center">{{ $item->nom }}</td>
                  <td class="center">{{ $item->prenom }}</td>
                  <td class="center">{{ $item->ville }}</td>
                  <td class="center">{{ getMagasinName($item->id_magasin) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>&nbsp;</p>

    </div>
</body>

</html>
