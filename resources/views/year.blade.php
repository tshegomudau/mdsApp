<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Holiday') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
        
            <form method="POST" action="/year">

                <div class="form-group" >
                    
                    <input type='number' placeholder="Enter year you want holiday for" name="datetimepicker" id='datetimepicker' min="2013" max="2050" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" />
                     
                    @if ($errors->has('datetimepicker'))
                        <span class="text-danger">{{ $errors->first('datetimepicker') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Read holidays</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
    $(function(){
        $('#datetimepicker').datepicker({
        changeYear: true,
        showButtonPanel: false,
        yearRange: '2013:2050',
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    }).focus(function () {
        $(".ui-datepicker-prev, .ui-datepicker-next").remove();
        $(".ui-datepicker-month").remove();
        $(".ui-datepicker-calendar").remove();
    });
    
});
</script>
</x-app-layout>
