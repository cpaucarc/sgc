<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col w-full">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-6">
        <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden border-b border-zinc-300 rounded-lg border border-zinc-300">
                <table class="min-w-full divide-y divide-zinc-300">
                    @if(isset($head))
                        <thead class="bg-neutral-100">
                        <tr>
                            {{$head}}
                        </tr>
                        </thead>
                    @endif

                    <tbody class="bg-white divide-y divide-zinc-200">
                    {{ $body }}
                    </tbody>

                    @if(isset($foot))
                        <tfoot class="text-sm text-zinc-700 bg-neutral-100/75 hover:bg-neutral-100/75 font-bold">
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
