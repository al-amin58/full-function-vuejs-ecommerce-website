<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Contact US" />
    <AppLayout>
        <section class="bg-dark">
            <div class="container " style="background-color: #E9ECEF">
                <div class="row p-5">
                    <div class="col-lg-9">
                        <h1 class="pt-4 pb-4">Quick Contact </h1>
                        <div class="form">
                            <div class="mb-3">
                                <label for="name" class="form-label"> Name </label>
                                <input type="text" class="form-control border p-2 w-100" id="name" placeholder="Inter Your Full Name... ">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="email" class="form-label"> Email </label>
                                    <input type="email" class="form-control border p-2 w-100" id="email" placeholder="Email Address ">
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="number" class="form-label"> Mobile No.</label>
                                    <input type="number" class="form-control border p-2 w-100" id="number" placeholder="Mobile No ">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="company" class="form-label"> Company Name </label>
                                <input type="text" class="form-control border mb-5 p-2 w-100" id="company" placeholder="Company Name ">
                            </div>
                            <div>
                                <label for="companyDetails" class="form-label">Company Details </label>

                                <textarea id="companyDetails" name="companyDetails" rows="4"  class="form-control  border mb-5 w-100" ></textarea>
                            </div>
                            <div>
                                <label for="message" class="form-label">Message </label>

                                <textarea id="message" name="message" rows="4"  class="form-control  border mb-5 w-100" ></textarea>
                            </div>

                            <button type="button" class="button-primary"> Send </button>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="side-info">
                            <h1 class="pt-4 pb-4">Official Address</h1>
                            <h2>:: Corporate Office ::</h2>
                            <ul class="ps-4">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-house-door fs-3 text-dark"></i>
                                    <span class="text-dark">
                                     House # 17 (2nd floor),Road # 14, Sector # 13,Uttara, Dhaka-1230,
                                </span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4  text-dark"></i>
                                    <span class="text-dark">+88 02 8991698, 55086159</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <span class="text-dark">+88 02 8991698, 55086159</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <span class="text-dark"> visiontex08@dhaka.net</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <span class="text-dark"> visiontex08@gmail.com</span>
                                </li>
                            </ul>

                            <h2 class="mt-4">:: Sales Contact ::</h2>

                            <ul class="ps-4">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <span class="text-dark">sales@visiontexbd.net</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <span class="text-dark">+880 1311 064500 - 04</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <span class="text-dark"> +88 01711 112 760</span>
                                </li>
                            </ul>

                            <h2 class="mt-4">:: Services Contact ::</h2>

                            <ul class="ps-4">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <span class="text-dark">service@visiontexbd.net</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <span class="text-dark">+880 1311 064507 - 11</span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <span class="text-dark"> +88 01711 112 760</span>
                                </li>
                            </ul>

                            <h2 class="mt-4">:: Registeded Office ::</h2>
                            <ul class="ps-4">
                                <li class="d-flex  align-items-start gap-2">
                                    <i class="bi bi-house-door fs-3 pr-3 text-dark"></i>
                                    <span class="text-dark"> House # 17 (2nd floor),Road # 14, Sector # 13,Uttara, Dhaka-1230,
                                    </span>
                                </li>
                                <li class="d-flex  align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4  text-dark"></i>
                                    <span class="text-dark">+88 01711 112 760 </span>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <span class="text-dark">gsminstruments@gmail.com</span>
                                </li>
                            </ul>

                        </div>


                    </div>
                </div>
            </div>
        </section>
    </AppLayout>

</template>
<style scoped>
.side-info{
    text-align: left;
    ul{
        text-style:none;
    }
    h1{
        color: #E50102;
        font-weight: 400;
    }
    h2{
        font-weight: 400;
        color: #E50102;
    }
    p{
        text-align: left;
        padding-left: 90px;
        line-height: 28px;
        i{
            padding-right: 10px;
        }
    }
}

</style>
