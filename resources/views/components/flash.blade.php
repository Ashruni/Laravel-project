@if(session()->has('success'))
        <div style="margin-top:-155px;"
         x-data="{show: true}"
         x-init="setTimeout(()=>show=false,3000)"
         x-show="show"
         class="fixed left-0 bg-green-500 text-white py-1 px-4 rounded-xl"
         ><p>{{session()->get('success')}}</p>
        </div>
@endif
