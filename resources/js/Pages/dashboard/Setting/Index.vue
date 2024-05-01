<script setup>
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue'
import { Head } from '@inertiajs/vue3'

const url = ref([null]);

const onFileChange = (e) => {
    const file = e.target.files[0];
    url.value = URL.createObjectURL(file);
}

</script>

<template>
    <Head title="Settings" />
    <AuthenticatedLayout>
        <div class="settings">
            <div class="p-3 bg-white rounded shadow">
                <h2>Settings</h2>
            </div>
            <div class="row align-items-start mt-5">
                <div class="col-lg-3">
                    <div class="flex-column nav-pills me-3 bg-white shadow list-group" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <button class="list-group-item active" id="v-pills-frontend-setting-tab" data-bs-toggle="pill" data-bs-target="#v-pills-frontend-setting" type="button" role="tab" aria-controls="v-pills-frontend-setting" aria-selected="true">Frontend Setting</button>

                        <button class="list-group-item" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>

                        <button class="list-group-item" id="v-pills-social-link-tab" data-bs-toggle="pill" data-bs-target="#v-pills-social-link" type="button" role="tab" aria-controls="v-pills-social-link" aria-selected="false">Social Links</button>

                        <button class="list-group-item" id="v-pills-apprience-tab" data-bs-toggle="pill" data-bs-target="#v-pills-apprience" type="button" role="tab" aria-controls="v-pills-apprience" aria-selected="false">Apprience</button>

                        <button class="list-group-item" id="v-pills-smtp-tab" data-bs-toggle="pill" data-bs-target="#v-pills-smtp" type="button" role="tab" aria-controls="v-pills-smtp" aria-selected="false">SMTP Setup</button>
                        <button class="list-group-item" id="v-pills-category-tab" data-bs-toggle="pill" data-bs-target="#v-pills-category" type="button" role="tab" aria-controls="v-pills-category" aria-selected="false">Category setting</button>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content bg-white shadow p-3 rounded secondary-top-bar" id="v-pills-tabContent">

                        <div class="tab-pane fade show active " id="v-pills-frontend-setting" role="tabpanel" aria-labelledby="v-pills-frontend-setting-tab" tabindex="0">
                            <h3>Frontend Setup</h3>
                            <div class="p-5">
                                <form>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="ISO Holdings"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <textarea
                                        class="bt-border-color p-2 iso-sm-rounded w-100 fw-medium iso-text-color"
                                        spellcheck="false"
                                        >Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, eligendi!</textarea>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <button class="button-primary">Submit</button>
                                        <button class="button-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <h3>Profile</h3>
                            <div class="p-5">
                                <form>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="The Imperial Irish Kingdom, Mo-03 (3rd Floor), Merul Badda, Dhaka 1212"
                                        />
                                    </div>

                                    <div class="mb-3">
                                        <input
                                            type="email"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="info@creativetechpark.com"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="98765435678"
                                        />
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <button class="button-primary">Submit</button>
                                        <button class="button-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-social-link" role="tabpanel" aria-labelledby="v-pills-social-link-tab" tabindex="0">
                            <h3>Social Links</h3>
                            <div class="p-5">
                                <form>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="https://www.facebook.com/CreativeTechPark/"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="https://www.facebook.com/CreativeTechPark/"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="https://www.facebook.com/CreativeTechPark/"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="w-100 p-2 bt-border-color iso-sm-rounded fw-medium iso-text-color"
                                            value="https://www.facebook.com/CreativeTechPark/"
                                        />
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mt-2">
                                        <button class="button-primary">Submit</button>
                                        <button class="button-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="v-pills-apprience" role="tabpanel" aria-labelledby="v-pills-apprience-tab" tabindex="0">
                            <h3>Apprience</h3>
                            <div class="p-5">
                                <form>
                                    <div class="mb-3">
                                        <div>
                                            <InputLabel for="header_logo" value="Header Logo (160px*50px)" class="mb-1" />
                                            <label for="header_logo" class="img-upload bt-border-color">
                                                <span>Upload Logo</span>
                                                <i class="bi bi-cloud-arrow-up"></i>
                                                <input type="file" @change="onFileChange" id="header_logo" />
                                            </label>
                                        </div>

                                        <div id="preview">
                                            <img v-if="url" :src="url" style="width:200px; height:auto;margin-top:10px;"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div>
                                            <InputLabel for="mobile_logo" value="Mobile Logo" class="mb-1" />
                                            <label for="mobile_logo" class="img-upload bt-border-color">
                                                <span>Upload Logo</span>
                                                <i class="bi bi-cloud-arrow-up"></i>
                                                <input type="file" @change="onFileChange" id="mobile_logo" />
                                            </label>
                                        </div>

                                        <div id="preview">
                                            <img v-if="url" :src="url" style="width:200px; height:auto;margin-top:10px;"/>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div>
                                            <InputLabel for="favicon" value="Favicon" class="mb-1" />
                                            <label for="favicon" class="img-upload bt-border-color">
                                                <span>Upload Logo</span>
                                                <i class="bi bi-cloud-arrow-up"></i>
                                                <input type="file" @change="onFileChange" id="favicon" />
                                            </label>
                                        </div>

                                        <div id="preview">
                                            <img v-if="url" :src="url" style="width:200px; height:auto; margin-top:10px;"/>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-3 mt-5">
                                        <button class="button-primary">Submit</button>
                                        <button class="button-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-smtp" role="tabpanel" aria-labelledby="v-pills-smtp-tab" tabindex="0">
                            <h3>SMTP Setup</h3>
                            <div class="p-5">
                                <form>
                                    <div class="mb-3">
                                        <InputLabel for="mail_driver" value="Mail Driver" />
                                        <select class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium">
                                            <option value="smtp">SMTP</option>
                                            <option value="send-mail">Sendmail</option>
                                            <option value="mail-gun">Mailgun</option>
                                            <option value="log">Log</option>
                                            <option value="array">Array</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="mail_host" value="Mail Host" class="mb-1" />
                                        <input
                                        type="email"
                                        value="host39.registrar-servers.com"
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="mail_port" value="Mail Port" class="mb-1" />
                                        <input
                                        type="text"
                                        value="465"
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="username" value="Username" class="mb-1" />
                                        <input
                                        type="text"
                                        value="test@ctpse.info"
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="password" value="Password" class="mb-1" />
                                        <input
                                        type="text"
                                        value="}x(]tz9(j8y["
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="from_email" value="From Email" class="mb-1" />
                                        <input
                                        type="email"
                                        value="test@amblefashion.com"
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="from_name" value="From Name" class="mb-1" />
                                        <input
                                        type="text"
                                        value="Test Crm"
                                        class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium"
                                        />
                                    </div>
                                    <div class="mb-3">
                                        <InputLabel for="encryption" value="Encryption" class="mb-1" />
                                        <select class="iso-sm-rounded bt-border-color p-2 w-100 iso-text-color fw-medium">
                                            <option selected disabled>Select Mail Encryption</option>
                                            <option value="null">Null</option>
                                            <option value="tsl">TSL</option>
                                            <option value="ssl">SSL</option>
                                        </select>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 mt-5">
                                        <button class="button-primary">Submit</button>
                                        <button class="button-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-category-tab" tabindex="0">
                            <h3>Category Setting</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

