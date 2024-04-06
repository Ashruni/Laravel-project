@if(session()->has('success'))
        <div
         x-data="{show: true}"
         x-init="setTimeout(()=>show=false,3000)"
         x-show="show"
         class="fixed left-0 bg-pink-500 text-white py-1 px-4 rounded-xl"
         ><p>{{session()->get('success')}}</p>
        </div>
@endif
