<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">CSV Import</div>

						<div class="panel-body">
							{{ csrf_field() }}

							<table class="table">
								<tr>
									@foreach ($header as $header_field)
										<th>{{ $header_field }}</th>
									@endforeach
								</tr>
								@foreach ($allRows as $row)
									<tr>
									@foreach ($row as $key => $value)
										<td>{{ $value }}</td>
									@endforeach
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
