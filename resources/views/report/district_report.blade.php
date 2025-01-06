@if((isset($all_summaries) && !empty($all_summaries)) || (isset($districts_summary) && !empty($districts_summary)))
@if(isset($all_summaries) && $all_summaries)
@foreach ($all_summaries as $type => $summary_groups)
@if ($type === 'SPECIFIC_DISTRICT')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Districts</h4>
            <div class="data-table-wrapper">
                <table id="basic-datatable" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>District</th>
                            <th>Total Inventory</th>
                            <th>Total Student Present</th>
                            <th>Total Consumption</th>
                            <th>Inventory in Hand</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($all_summaries) && $all_summaries)
                        @foreach ($all_summaries as $type => $summary_groups)
                        @if ($type === 'SPECIFIC_DISTRICT')
                        @foreach ($summary_groups[0] as $index => $summary)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $summary->district }}</td>
                            <td>{{ number_format($summary->total_inventory) }}</td>
                            <td>{{ number_format($summary->total_class_present) }}</td>
                            <td>{{ number_format($summary->total_consumed) }}</td>
                            <td>{{ number_format($summary->stock_in_hand) }}</td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        @endif

                        @if(isset($districts_summary) && $districts_summary)
                        @forelse ($districts_summary as $index => $summary)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $summary->district }}</td>
                            <td>{{ number_format($summary->total_inventory) }}</td>
                            <td>{{ number_format($summary->total_class_present) }}</td>
                            <td>{{ number_format($summary->total_consumed) }}</td>
                            <td>{{ number_format($summary->stock_in_hand) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No data available</td>
                        </tr>
                        @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($all_summaries) && $all_summaries)
@foreach ($all_summaries as $type => $summary_groups)
@if ($type === 'TEHSIL')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Tehsils</h4>
            <div class="data-table-wrapper">
                <table id="tehsil-summary" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>Date</th>
                            <th>Tehsil</th>
                            <th>Total Inventory</th>
                            <th>Total Student Present</th>
                            <th>Total Consumption</th>
                            <th>Inventory in Hand</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary_groups[0] as $index => $summary)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($summary->calculated_on)->format('Y-m-d') }}</td>
                            <td>{{ $summary->tehsil_name }}</td>
                            <td>{{ number_format($summary->total_inventory) }}</td>
                            <td>{{ number_format($summary->total_class_present) }}</td>
                            <td>{{ number_format($summary->total_consumed) }}</td>
                            <td>{{ number_format($summary->stock_in_hand) }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div>
@endif
@endforeach
@endif

@if(isset($all_summaries) && $all_summaries)
@foreach ($all_summaries as $type => $summary_groups)
@if ($type === 'ALL_MARKAZ')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">All Markaz</h4>
            <div class="data-table-wrapper">
                <table id="basic-datatable" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>Date</th>
                            <th>Markaz</th>
                            <th>Total Inventory</th>
                            <th>Total Student Present</th>
                            <th>Total Consumption</th>
                            <th>Inventory in Hand</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary_groups[0] as $index => $summary)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($summary->calculated_on)->format('Y-m-d') }}</td>
                            <td>{{ $summary->tehsil_name }}</td>
                            <td>{{ number_format($summary->total_inventory) }}</td>
                            <td>{{ number_format($summary->total_class_present) }}</td>
                            <td>{{ number_format($summary->total_consumed) }}</td>
                            <td>{{ number_format($summary->stock_in_hand) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div>
</div>
@endif
@endforeach
@endif

@if(isset($all_summaries) && $all_summaries)
@foreach ($all_summaries as $type => $summary_groups)
@if ($type === 'SCHOOL')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">All Schools</h4>
            <div class="data-table-wrapper">
                <table id="basic-datatable" class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Sr.#</th>
                            <th>Date</th>
                            <th>EMIS</th>
                            <th>School</th>
                            <th>Total Inventory</th>
                            <th>Total Student Present</th>
                            <th>Total Consumption</th>
                            <th>Inventory in Hand</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summary_groups[0] as $index => $summary)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($summary->calculated_on)->format('Y-m-d') }}</td>
                            <td>{{ $summary->emis_code }}</td>
                            <td>{{ $summary->school_name }}</td>
                            <td>{{ number_format($summary->total_inventory) }}</td>
                            <td>{{ number_format($summary->total_class_present) }}</td>
                            <td>{{ number_format($summary->total_consumed) }}</td>
                            <td>{{ number_format($summary->stock_in_hand) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div>
@endif
@endforeach
@endif