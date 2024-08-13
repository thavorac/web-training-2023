<script setup lang="ts"></script>

<template>
    <div class="bg-slate-400 min-h-screen w-1/2 mx-auto">
        <p class="text-2xl font-bold p-4">Purchase Receipt</p>
        <div class="grid grid-cols-2 gap-5">
            <div>
                <p>Address : Phnom Penh , Tuol Kork , Samnong 12</p>
            </div>
            <div>
                <p>Date : 08/11/2024</p>
            </div>
        </div>
        <div>
            <table class="w-4/5 border-collapse  mx-auto mt-10">
                <thead>
                    <tr class=" p-2 text-center">
                        <th class="border border-black">No</th>
                        <th class="border border-black">Description Item</th>
                        <th class="border border-black">Price </th>
                        <th class="border border-black">Qty</th>
                        <th class="border border-black">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-black">0001</td>
                        <td class="border border-black">Product A , product B</td>
                        <td class="border border-black">$ 15</td>
                        <td class="border border-black">10</td>
                        <td class="border border-black">$ 150</td>
                    </tr>

                    <tr>
                        <td class="border border-black">0001</td>
                        <td class="border border-black">Product A , product B</td>
                        <td class="border border-black">$ 15</td>
                        <td class="border border-black">10</td>
                        <td class="border border-black">$ 150</td>
                    </tr>
                    <tr>
                        <td class="border border-black">0001</td>
                        <td class="border border-black">Product A , product B</td>
                        <td class="border border-black">$ 15</td>
                        <td class="border border-black">10</td>
                        <td class="border border-black">$ 150</td>
                    </tr>
                    <tr>
                        <td class="border border-black">0001</td>
                        <td class="border border-black">Product A , product B</td>
                        <td class="border border-black">$ 15</td>
                        <td class="border border-black">10</td>
                        <td class="border border-black">$ 150</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>