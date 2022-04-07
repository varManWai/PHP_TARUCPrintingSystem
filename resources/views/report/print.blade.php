@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container">
    <div class="row gy-5">
        <div class="col"></div>
        <div class="col-8">
            @if ($order=='Empty')
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-8 text-center">
                    <img src="{{url('/image/empty.png')}}" alt="">
                    <h1 style="color: red" class="text-center mt-3"><b>Nothing to show</b></h1>
                    <h2 style="color: red" class="text-center">Currently you do not have any sales to generate report.</h2>
                </div>
                <div class="col"></div>
            </div>
            @else
            
            <div class="d-flex justify-content-center">
                @if ($type==0)
                <h1><b>Daily Report ({{$date}})</b></h1>
                @endif
                @if ($type==1)
                <h1><b>Monthly Report ({{date('M',strtotime($date))}})</b></h1>
                @endif
                
                @if ($type==2)
                <h1><b>Yearly Report ({{date('Y',strtotime($date))}})</b></h1>
                @endif
            </div>
            
            {{-- DailyReport --}}
            @if ($type==0)
            
            @if ($numberOfSales==0)
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-8 text-center">
                    <img src="{{url('/image/empty.png')}}" alt="">
                    <h1 style="color: red" class="text-center mt-3"><b>Nothing to show</b></h1>
                    <h2 style="color: red" class="text-center">Today you do not have any sales to generate report.</h2>
                </div>
                <div class="col"></div>
            </div>

            @else
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Total Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$totalSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Number of Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">{{$numberOfSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Highest Sales Of The Day</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$highestSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                
                @foreach ($subjectDetails as $item)
                <input type="hidden" name="title[]" value="{{$item->courseCode}}">
                <input type="hidden" name="courseCode[]" value="{{$item->courseCode}}">
                <input type="hidden" name="quantity[]" value="{{$item->Quantity}}">
                @endforeach
                <div class="col"></div>
                <div class="col-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header text-center">Quantities of Subject (Sold)</div>
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:600px:min-width:300px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="text-center">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                </div>
            </div>
            @endif
            @endif    
            {{-- DailyReport(END) --}}
            
            {{-- MonthlyReport --}}
            @if ($type==1)
            
            @if ($numberOfSales==0)
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-8 text-center">
                    <img src="{{url('/image/empty.png')}}" alt="">
                    <h1 style="color: red" class="text-center mt-3"><b>Nothing to show</b></h1>
                    <h2 style="color: red" class="text-center">This month you do not have any sales to generate report.</h2>
                </div>
                <div class="col"></div>
            </div>
            
            @else
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Total Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$totalSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Number of Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">{{$numberOfSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Day</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerDay}}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Highest Sales Of The Month</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$highestSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            
            <div class="row justify-content-center">
                
                @foreach ($subjectDetails as $item)
                <input type="hidden" name="title[]" value="{{$item->courseCode}}">
                <input type="hidden" name="courseCode[]" value="{{$item->courseCode}}">
                <input type="hidden" name="quantity[]" value="{{$item->Quantity}}">
                @endforeach
                <div class="col"></div>
                <div class="col-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header text-center">Quantities of Subject (Sold)</div>
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:600px:min-width:300px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="text-center">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                </div>
            </div>
            @endif
            @endif    
            {{-- MonthlyReport(END) --}}
            
            {{-- YearlyReport --}}
            @if ($type==2)
            
            @if ($numberOfSales==0)
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-8 text-center">
                    <img src="{{url('/image/empty.png')}}" alt="">
                    <h1 style="color: red" class="text-center mt-3"><b>Nothing to show</b></h1>
                    <h2 style="color: red" class="text-center">This year you do not have any sales to generate report.</h2>
                </div>
                <div class="col"></div>
            </div>
            
            
            @else
            <div class="row mt-4 justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Total Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$totalSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Number of Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">{{$numberOfSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Sales</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Day</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerDay}}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col"></div>
            </div>
            <div class="row justify-content-center">
                <div class="col"></div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Average Per Month</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$averagePerMonth}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card text-dark bg-light mb-3" style="max-width: 18rem;margin:auto">
                        <div class="card-header text-center">Highest Sales Of The Year</div>
                        <div class="card-body">
                            <p class="card-text text-center">RM{{$highestSales}}</p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            
            <div class="row justify-content-center">
                
                @foreach ($subjectDetails as $item)
                <input type="hidden" name="title[]" value="{{$item->courseCode}}">
                <input type="hidden" name="courseCode[]" value="{{$item->courseCode}}">
                <input type="hidden" name="quantity[]" value="{{$item->Quantity}}">
                @endforeach
                <div class="col"></div>
                <div class="col-12">
                    <div class="card text-dark bg-light mb-3">
                        <div class="card-header text-center">Quantities of Subject (Sold)</div>
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:600px:min-width:300px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="text-center">
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                </div>
            </div>
            @endif
            @endif    
            {{-- YearlyReport(END) --}}
            
            @endif
        </div>
        <div class="col"></div>
    </div>
</div>


<script type="text/javascript">
    var title = document.getElementsByName('title[]');
    var courseCode = document.getElementsByName('courseCode[]');
    var quantity = document.getElementsByName('quantity[]');
    const xValues = [];
    const yValues = [];
    const barColors = [];
    
    for (var i=0; i<title.length;i++){
        xValues[i] = title[i].value;
        yValues[i] = quantity[i].value;
        const randomColor = Math.floor(Math.random()*16777215).toString(16);
        barColors[i] = "#" + randomColor;
    }
    
    
    new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        }
        
    });
</script>
@endsection