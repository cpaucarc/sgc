<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col w-full">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-6">
            <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    @if(isset($head))
                        <thead class="bg-gray-50">
                        {{$head}}
                        </thead>
                    @endif
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{ $body }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
