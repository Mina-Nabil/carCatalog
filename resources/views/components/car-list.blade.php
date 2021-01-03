<?php $i=0 ;  
    $listCount = count($cars);
    $pagesCount = ceil($listCount/5);
?>
@foreach($cars as $car)
<div class="product-listing-m gray-bg" id="item{{$i}}"  
style="{{(0<=$i && $i <5) ? 'display:block' : 'display:none'}}"
>
    <div class="product-listing-img"> <a href="{{url('car/' . $car->id)}}"><img src="{{($car->image) ? asset('storage/' . $car->image) : asset('assets/frontend/images/600x380.jpg')}}"
                class="img-fluid" alt="image" />
        </a>
        <div class="label_icon">New</div>
        <div class="compare_item">
            <div class="checkbox">
                <input type="checkbox" value="" id="compare22">
                <label for="compare22">Compare</label>
            </div>
        </div>
    </div>
    <div class="product-listing-content">
        <h5><a href="#">{{$car->model->MODL_NAME}} {{$car->CAR_CATG}}</a></h5>
        <p class="list-price">{{number_format($car->CAR_PRCE)}}EGP</p>
        <ul>
            <li><i class="fa fa-database" aria-hidden="true"></i>{{$car->CAR_ENCC}}</li>
            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$car->model->MODL_YEAR}}</li>
            <li><i class="fa fa-rocket" aria-hidden="true"></i>{{$car->CAR_HPWR}} hp</li>
            <li><i class="fa fa-tachometer" aria-hidden="true"></i>{{$car->CAR_ACC}} sec to 100km/h</li>
            <li><i class="fa fa-superpowers" aria-hidden="true"></i>{{$car->CAR_TORQ}} kW</li>
            <li><i class="fa fa-car" aria-hidden="true"></i>{{$car->CAR_DIMN}}</li>
        </ul>
        <a href="{{url('car/' . $car->id)}}" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
    </div>
</div>
<?php $i++ ?>
@endforeach


<div class="pagination">
    <ul>
        @for ($page = 0; $page < $pagesCount; $page++) @if($page==0) <li id="page{{$page}}" class="current"><a href="javascript::void(0)" onclick="showPage({{$page*5}}, {{($page+1)*5-1}})">{{$page+1}}</a></li>
            @else
            <li id="page{{$page}}"><a href="javascript::void(0)"  onclick="showPage({{$page*5}}, {{($page+1)*5-1}})">{{$page+1}}</a></li>
            @endif
            @endfor
    </ul>
</div>


<script>
    function showPage(startIndex, endIndex){
    for(i = 0 ; i<{{$listCount}} ; i++){
        itemDiv = document.getElementById('item' + i);
        if(startIndex<=i && i<=endIndex)
            itemDiv.style="display:block";
        else
            itemDiv.style="display:none";
    }
    for(p=0 ; p < {{$pagesCount}} ; p++)
        pageDiv = document.getElementById("page" + (startIndex/5))
    if(p==startIndex/5)
        pageDiv.className="current";
    else
        pageDiv.className="";

}

</script>