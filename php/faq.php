<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Finegap Datatables</title>

    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

    <style type="text/css">
        body {
            background: #c9dad6;
        }
		table{
			margin-bottom:30px;
			border-bottom: 1px solid rgba(0,0,0,0.3);
			padding-top:10px;
			padding-bottom: 10px;
			
		}
        .dataTables_scrollHeadInner {
            margin: 0 auto;
        }
		table select{
			min-width: 50px;
			width: auto;
		}
		table  tr td{
			border: 1px solid rgba(0,0,0,0.2);
		}
		table  tr th{
			min-width:100px;
			padding: 0 5px !important;
		}
		table  tr.even td{
			background: #e2f3e2;
		}
		table .listingname{
			min-width: 150px;
		}
		.dt-buttons{
			margin: 10px 0;
            text-align: center;
		}
		.dt-buttons a{
            padding: 5px 10px;
            border: 1px solid rgba(0,0,0,0.2);
            background: #0b7e31;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
		}
        h2.heading {
            text-align: center;
        }
		table .dataTable{margin: inherit !important;}
        table tr td {
            overflow: hidden !important;
            word-break: break-word !important;
        }
	</style>
    <script>
        jQuery(document).ready( function () {
			jQuery('#finegap-table').DataTable({
				"scrollX": true,
				dom: 'Blfrtip',
				"lengthMenu": [ 10, 25, 50, 75, 100 ],
				buttons: [ {
					extend: 'csv',
					text: 'Export csv'
				}]
			});
		} );
    </script>

  </head>
  <body>
    <h2 class="heading">jQuery Datatables</h2>
    <table id="finegap-table" width="700px">
        <thead>
            <tr>
                <th>Col1</th>
                <th>Col2</th>
                <th>Col3</th>
                <th>Col4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
            <tr>
                <td>data-1a</td>
                <td>data-2b</td>
                <td>data-3c</td>
                <td>data-4d</td>
            </tr>
        </tbody>
    </table>

  </body>
</html>