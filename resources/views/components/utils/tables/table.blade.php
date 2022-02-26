<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col w-full">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-6">
        <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden border-b border-stone-200 rounded-lg border border-stone-200">
                <table class="min-w-full divide-y divide-stone-200">
                    @if(isset($head))
                        <thead class="bg-stone-50">
                        <tr>
                            {{$head}}
                        </tr>
                        </thead>
                    @endif

                    <tbody class="bg-white divide-y divide-stone-200">
                    {{ $body }}
                    </tbody>

                    @if(isset($foot))
                        <tfoot class="text-sm text-gray-600 bg-stone-50/75 hover:bg-stone-100/50 font-bold">
                        <tr>
                            {{$foot}}
                        </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
