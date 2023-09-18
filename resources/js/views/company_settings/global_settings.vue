<template>
    <div v-if="show">
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
            <h1 class="w-full pb-5 pt-3 text-center font-bold pl-3" style=" font-size: x-large">
                Company Settings
            </h1>
        </div>
        <div class="card-container mb-2">
            <div  class="flex-auto flex flex-wrap sm:flex-nowrap sm:items-center" v-for="(image, index) in com" :key="index">
                <div class="w-full sm:w-1/12 pl-3 sm:mb-0 shows pb-5">
                    <div class="card" @click="onCompany(image)">
                        <img :src="`/uploads/company/logo/` +  image.logo" >
                        <div class="card__content">
                            <p class="card__title">{{ image.country ?  image.country.text:'' }}</p>
                            <p class="card__description">{{image.city ?  image.city.text:'' }}</p>
                        </div>
                    </div>
                    <span class="text-gray-500 font-bold text-sm pl-3">{{ image.name }}</span>
                </div>
            </div>
        </div>
        <hr/>
        <div class="w-full radio-inputs mb-4 mt-4 ml-3">
            <label>
                <input
                    class="radio-input"
                    type="radio"
                    name="engine"
                    @click="smstabs"
                />
                <span class="radio-tile">
                    <span class="radio-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1em"
                            viewBox="0 0 512 512"
                            >
                            <path
                                d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM202.9 176.8c6.5-2.2 13.7 .1 17.9 5.6L256 229.3l35.2-46.9c4.1-5.5 11.3-7.8 17.9-5.6s10.9 8.3 10.9 15.2v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V240l-19.2 25.6c-3 4-7.8 6.4-12.8 6.4s-9.8-2.4-12.8-6.4L224 240v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-6.9 4.4-13 10.9-15.2zm173.1 38c0 .2 0 .4 0 .4c.1 .1 .6 .8 2.2 1.7c3.9 2.3 9.6 4.1 18.3 6.8l.6 .2c7.4 2.2 17.3 5.2 25.2 10.2c9.1 5.7 17.4 15.2 17.6 29.9c.2 15-7.6 26-17.8 32.3c-9.5 5.9-20.9 7.9-30.7 7.6c-12.2-.4-23.7-4.4-32.6-7.4l0 0 0 0c-1.4-.5-2.7-.9-4-1.4c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c1.7 .6 3.3 1.1 4.9 1.6l0 0 0 0c9.1 3.1 15.6 5.3 22.6 5.5c5.3 .2 10-1 12.8-2.8c1.2-.8 1.8-1.5 2.1-2c.2-.4 .6-1.2 .6-2.7l0-.2c0-.7 0-1.4-2.7-3.1c-3.8-2.4-9.6-4.3-18-6.9l-1.2-.4c-7.2-2.2-16.7-5-24.3-9.6c-9-5.4-17.7-14.7-17.7-29.4c-.1-15.2 8.6-25.7 18.5-31.6c9.4-5.5 20.5-7.5 29.7-7.4c10 .2 19.7 2.3 27.9 4.4c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-7.3-1.9-14.1-3.3-20.1-3.4c-4.9-.1-9.8 1.1-12.9 2.9c-1.4 .8-2.1 1.6-2.4 2c-.2 .3-.4 .8-.4 1.9zm-272 0c0 .2 0 .4 0 .4c.1 .1 .6 .8 2.2 1.7c3.9 2.3 9.6 4.1 18.3 6.8l.6 .2c7.4 2.2 17.3 5.2 25.2 10.2c9.1 5.7 17.4 15.2 17.6 29.9c.2 15-7.6 26-17.8 32.3c-9.5 5.9-20.9 7.9-30.7 7.6c-12.3-.4-24.2-4.5-33.2-7.6l0 0 0 0c-1.3-.4-2.5-.8-3.6-1.2c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c1.4 .5 2.8 .9 4.1 1.4l0 0 0 0c9.5 3.2 16.5 5.6 23.7 5.8c5.3 .2 10-1 12.8-2.8c1.2-.8 1.8-1.5 2.1-2c.2-.4 .6-1.2 .6-2.7l0-.2c0-.7 0-1.4-2.7-3.1c-3.8-2.4-9.6-4.3-18-6.9l-1.2-.4 0 0c-7.2-2.2-16.7-5-24.3-9.6C80.8 239 72.1 229.7 72 215c-.1-15.2 8.6-25.7 18.5-31.6c9.4-5.5 20.5-7.5 29.7-7.4c9.5 .1 22.2 2.1 31.1 4.4c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-6.6-1.8-16.8-3.3-23.3-3.4c-4.9-.1-9.8 1.1-12.9 2.9c-1.4 .8-2.1 1.6-2.4 2c-.2 .3-.4 .8-.4 1.9z"
                            />
                        </svg>
                    </span>
                    <span class="radio-label">SMS</span>
                </span>
            </label>
            <label class="">
                <input
                    class="radio-input"
                    type="radio"
                    name="engine"
                    @click="emailtabs"
                />
                <span class="radio-tile">
                    <span class="radio-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1em"
                            viewBox="0 0 512 512"
                            >
                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
                            />
                        </svg>
                    </span>
                    <span class="radio-label">Email</span>
                </span>
            </label>
            <label>
                <input
                class="radio-input"
                type="radio"
                name="engine"
                @click="couriertabs"
                />
                <span class="radio-tile">
                    <span class="radio-icon">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1em"
                            viewBox="0 0 640 512"
                            >
                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                            />
                        </svg>
                    </span>
                    <span class="radio-label">Courier</span>
                </span>
            </label>
        </div>
        <hr />
        <div class="p-6" v-if="sms">
            <h1 class="text-lg font-bold mb-4">SMS Settings</h1>
            <div v-if="show_company_data">
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label class="block font-medium text-sm text-gray-700 mb-2">Login Id</label>
                        <input
                            class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                            type="text"
                            v-model="form.login_id"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.login_id">
                        {{ error.login_id[0] }}
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label class="block font-medium text-sm text-gray-700 mb-2">Password</label>
                        <input
                            class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                            type="password"
                            v-model="form.password"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.password">
                        {{ error.password[0] }}
                        </p>
                    </div>
                    <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                        <label class="block font-medium text-sm text-gray-700 mb-2">Mask</label>
                        <input
                            class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                            type="text"
                            v-model="form.mask"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.mask">
                            {{ error.mask[0] }}
                        </p>
                    </div>
                </div>
                <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                    <div class="w-full sm:w-full mb-4 sm:mb-0 p-2">
                        <label class="block font-medium text-sm text-gray-700 mb-2">URL</label>
                        <input
                            class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                            type="text"
                            v-model="form.url"
                        />
                        <p class="text-red-600 text-xs italic" v-if="error.url">
                            {{ error.url[0] }}
                        </p>
                    </div>
                </div>
                <div class="flex justify-end mt-8 space-x-4">
                    <button
                        @click="savejson('sms_settings')"
                        class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
                        type="button"
                    >
                        {{
                        $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add"
                        }}
                    </button>
                </div>
            </div>
        </div>
        <div class="p-6" v-if="email">
            <h1 class="text-lg font-bold mb-4">Email Settings</h1>
                <div v-if="show_company_data">
                    <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
                        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Title</label>
                            <input
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="text"
                                v-model="form.title"
                            />
                            <p class="text-red-600 text-xs italic" v-if="error.title">
                                {{ error.title[0] }}
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Host</label>
                            <input
                                class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
                                type="text"
                                v-model="form.host"
                            />
                            <p class="text-red-600 text-xs italic" v-if="error.host">
                                {{ error.host[0] }}
                            </p>
                        </div>
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2"
              >Username
            </label>
            <input
              class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
              type="email"
              v-model="form.username"
            />
            <p class="text-red-600 text-xs italic" v-if="error.username">
              {{ error.username[0] }}
            </p>
          </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              Password
            </label>
            <input
              class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
              type="password"
              v-model="form.password"
            />
            <p class="text-red-600 text-xs italic" v-if="error.password">
              {{ error.password[0] }}
            </p>
          </div>

          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              Port
            </label>
            <input
              class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
              type="number"
              v-model="form.port"
            />
            <p class="text-red-600 text-xs italic" v-if="error.port">
              {{ error.port[0] }}
            </p>
          </div>
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              SMTPSecure
            </label>
            <input
              class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
              type="text"
              v-model="form.smtp"
            />
            <p class="text-red-600 text-xs italic" v-if="error.smtp">
              {{ error.smtp[0] }}
            </p>
          </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              From Email
            </label>
            <input
              class="w-full py-2 px-3 bg-white h-8 border border-gray-300 rounded-md"
              type="email"
              v-model="form.form_email"
            />
            <p class="text-red-600 text-xs italic" v-if="error.form_email">
              {{ error.form_email[0] }}
            </p>
          </div>
        </div>
        <div class="flex justify-end mt-8 space-x-4">
          <button
            @click="savejson('email_settings')"
            class="inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
            type="button"
          >
            {{
              $route.meta.mode && $route.meta.mode === "edit" ? "Update" : "Add"
            }}
          </button>
        </div>
      </div>
    </div>
   
    <div class="" v-if="courier">
        <h1 class="text-lg font-bold text-center mb-4 mt-4">Courier Settings</h1>
            <div class="card-container mb-6">
                <div  class="flex-auto flex flex-wrap sm:flex-nowrap sm:items-center" v-for="stores in stores_data" >
                    <div class="w-full sm:w-1/8 pl-3 sm:mb-0 shows" @click="create_store(stores)">
                        <div class="radio-inputs">
                            <label>
                                <input
                                    class="radio-input"
                                    type="radio"
                                    name="engine"
                                />
                                <span class="radio-title">
                                    <span class="radio-icon">
                                        <!-- <i class="fa-solid fa-shop fa-2x" style="color: #d89d4b;"></i> -->
                                        <img src="/images/shopify-bag.png" class="w-16 h-16 rounded ml-3" v-if="stores.plate_form == 'Shopify'" @click="ecommerce('shopify')"/>
                                        <img src="/images/wordpress.png" class="w-16 h-16 rounded ml-3" v-if="stores.plate_form == 'WooCommerce'" @click="ecommerce('woocommerce')"/>
                                        <img src="/images/mimcart.png" class="w-16 h-16 rounded ml-3" v-if="stores.plate_form == 'MimCart'" @click="ecommerce('MimCart')"/>
                                    </span>
                                    <span class="radio-label font-bold">{{stores ?  stores.name:'' }} Store</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr>
            <br>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="bg-white p-2 rounded ">
                    <img src="/images/wordpress.png" alt="WordPress Logo" class="w-20 h-20 mx-auto mb-2 rounded-full">
                    <h2 class="text-lg font-semibold text-center">WordPress</h2>
                </div>
                <div class="bg-white p-2 rounded">
                    <img src="/images/shopify-bag.png" alt="Shopify Logo" class="w-20 h-20 mx-auto mb-2 rounded-full">
                    <h2 class="text-lg font-semibold text-center">Shopify</h2>
                </div>
                <div class="bg-white p-2 rounded">
                    <img src="/images/mimcart.png" alt="Mim Cart Logo" class="w-20 h-20 mx-auto mb-2 rounded-full">
                    <h2 class="text-lg font-semibold text-center">Mim Cart</h2>
                </div>
            </div> -->
      <!-- <div class="flex-auto flex flex-col sm:flex-row sm:items-center">
        <div class=" mr-12 w-full sm:w-1/3 mb-4 sm:mb-0 p-2 bg-gray-50 border border-gray-300 rounded-md" style="box-shadow: 0 7px 15px rgba(16, 53, 78, 0.1); cursor: pointer;">
          <div  class=" flex flex-row w-full py-2 px-3 " @click="ecommerce('woocommerce')">
                    <div class="coin">
          <div class="side heads">
            <i class="fa-brands fa-wordpress" style="color: #b5bbc4;"></i>
            </div>
            <div class="side tails">
        <i class="fa-brands fa-wordpress" style="color: #b5bbc4;"></i>
            </div>
            </div>
            <h1 class="ml-12 mt-4"><strong style="color:rgb(40, 40, 104)">WordPress</strong><br><span style="font-size:small">Configration</span></h1>
          </div>
    </div>
    <div class="mr-12 w-full sm:w-1/3 mb-4 sm:mb-0 p-2 bg-gray-50 border border-gray-300 rounded-md" style="box-shadow: 0 7px 15px rgba(16, 53, 78, 0.1); cursor: pointer;">
          <div  class=" flex flex-row w-full py-2 px-3 " @click="ecommerce('shopify')">
                    <div class="coins" >
          <div class="side heads">
            <i class="fa-brands fa-shopify fa-xs" style="color: #bbc2ce;"></i>
            </div>
            <div class="side tails">
              <i class="fa-brands fa-shopify fa-xs" style="color: #bbc2ce; font-size: smaller;"></i>
            </div>
            </div>
            <h1 class="ml-12 mt-4"><strong style="color:rgb(31, 119, 19)">Shopify</strong><br><span style="font-size:small">Configration</span></h1>
          </div>
    </div>
    <div class=" w-full sm:w-1/3 mb-4 sm:mb-0 p-2 bg-gray-50 border border-gray-300 rounded-md" style="box-shadow: 0 7px 15px rgba(16, 53, 78, 0.1); cursor: pointer;">
          <div  class=" flex flex-row w-full py-2 px-3 " @click="ecommerce('MimCart')">
                    <div class="coin">
          <div class="side heads">
            <i class="fa-brands fa-wordpress" style="color: #b5bbc4;"></i>
            </div>
            <div class="side tails">
        <i class="fa-brands fa-wordpress" style="color: #b5bbc4;"></i>
            </div>
            
            </div>
            <h1 class="ml-12 mt-4"><strong style="color:rgb(40, 40, 104)">MimCart</strong><br><span style="font-size:small">Configration</span></h1>
          </div>
    </div>
       </div> -->
    </div>
                  <Modal :show="true" height="900"

              v-if="show_ecommerce"
              >

              <div >
                <h1 class="text-lg font-bold  mt-4 mb-4 text-center">Store Settings</h1>
                <hr>
      <div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'woocommerce'">
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" >
            <label class="block font-medium text-sm text-gray-700 mb-2"
              >Api Key
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.api_key"
            />

            <p class="text-red-600 text-xs italic" v-if="error.api_key">
              {{ error.api_key[0] }}
            </p>
          </div>
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2"
              >Api Secret</label
            >
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.api_secret"
            />
            <p class="text-red-600 text-xs italic" v-if="error.api_secret">
              {{ error.api_secret[0] }}
            </p>
          </div>

          
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'woocommerce'">
          <div class="w-full sm:w-full mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              WordPress Store Address
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.word_address"
            />
            <p class="text-red-600 text-xs italic" v-if="error.store_address">
              {{ error.store_address[0] }}
            </p>
          </div>
        </div>
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'shopify'">
          <div class="w-full sm:w-full mb-4 sm:mb-0 p-2" >
            <label class="block font-medium text-sm text-gray-700 mb-2"
              >Access Token
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.access_token"
            />

            <p class="text-red-600 text-xs italic" v-if="error.api_key">
              {{ error.api_key[0] }}
            </p>
          </div>
          <div class="w-full sm:w-1/2 mb-4 sm:mb-0 p-2" style="display:none">
            <label class="block font-medium text-sm text-gray-700 mb-2"
              >Api Secret</label
            >
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.api_secret"
            />
            <p class="text-red-600 text-xs italic" v-if="error.api_secret">
              {{ error.api_secret[0] }}
            </p>
          </div>
        </div>

        
        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'shopify'">
          

          <div class="w-full sm:w-full mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              Shopify Store Address
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.store_address"
            />
            <p class="text-red-600 text-xs italic" v-if="error.store_address">
              {{ error.store_address[0] }}
            </p>
          </div>
        </div>

        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'MimCart'">
          

          <div class="w-full sm:w-full mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              Mimcart Api Key
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.mim_api_key"
            />
            <p class="text-red-600 text-xs italic" v-if="error.store_address">
              {{ error.store_address[0] }}
            </p>
          </div>
        </div>


        <div class="flex-auto flex flex-col sm:flex-row sm:items-center" v-if="online_store_name == 'MimCart'">
          

          <div class="w-full sm:w-full mb-4 sm:mb-0 p-2">
            <label class="block font-medium text-sm text-gray-700 mb-2">
              Mimcart Store Address
            </label>
            <input
              class="w-full py-2 px-3 bg-gray-100 border border-gray-300 rounded-md"
              type="text"
              v-model="form.mim_store_address"
            />
            <p class="text-red-600 text-xs italic" v-if="error.store_address">
              {{ error.store_address[0] }}
            </p>
          </div>
        </div>
      
      </div>

              </div>





              <div class="flex justify-end mt-4 space-x-4 mb-6 mr-6">
                <button v-if="connection_button"
              @click="wordpress"
              class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-orange-400 text-white"
              type="button">
              Test Connecion
              </button>
              <button v-if="save_button"
              @click="save_store_data"
              class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-blue-400 text-white"
              type="button">
              Save
              </button>

              <button
              @click="close"
              class=" inline-flex justify-center items-center space-x-2 border font-semibold rounded-lg px-3 py-2 leading-5 text-sm border-gray-200 bg-red-400 text-white"
              type="button">
              Cancel
              </button>
              </div>
              </Modal>
  </div>
</template>

<script>
import { byMethod, get } from "@/libs/api";
import { form } from "@/libs/mixins";
import Typeahead from "@/Components/typeahead/typeahead.vue";
import Modal from "@/Components/Modal.vue";

function initialize(to) {
  let urls = {
    add: "/api/settings/create?key=sms_settings",

    edit: `/api/settings/${to.params.id}/edit`,
  };
  return urls[to.meta.mode] || urls.add;
}

export default {
  mixins: [form],
  components: {
    Typeahead, Modal
  },
  data() {
    return {
        show_company_data: false,
        email: false,
        sms: true,
        show_ecommerce:false,
        courier: false,
        save_button:false,
        connection_button:true,
        error: {},
        company_id: {},
        key: "sms_settings",
        show: false,
        resource: "/settings",
        store: "/api/settings",
        method: "POST",
        small: "settings",
        capital: "settings",
        title: "Add",
        message: "New settings Added",
        permissions: {},
        online_store_name:{},
        products: "/api/product",
        wearhouses: "/api/wearhouse",
        companys: "/api/company",
        com:[],
        stores_data:[],
        form: {}
    };
  },

  beforeRouteEnter(to, from, next) {
    get(initialize(to)).then((res) => {
      next((vm) => vm.setData(res));
    });
  },
  beforeRouteUpdate(to, from, next) {
    get(initialize(to)).then((res) => {
      this.setData(res);
      next();
    });
  },
  created(){
      byMethod("get","/api/company").then(
        (res) => {
           this.com = res.data.data.data;
        }
      );
  },
  methods: {

    close(){
      this.show_ecommerce = false
      this.connection_button = true 
      this.save_button = false
      // this.form = []
    },
    ecommerce(e){
      console.log(this.form.store_address);
      this.online_store_name = e;
      this.form.plate_form = e ;
      this.show = true
        this.show_ecommerce = true
    },

    wordpress(){

      
                let connention_url = ''
                if (this.online_store_name == 'shopify') {
                    
                    connention_url = '/api/shopify_fetch_data'
                } else if (this.online_store_name == 'woocommerce') {
                  connention_url = '/api/woocommerce_fetch_data'

                } else if (this.online_store_name == 'MimCart') {
                  
                    connention_url = '/api/mimcart_fetch_data'
                }
                if (this.form && connention_url) {
                    byMethod('post', connention_url, this.form).then(res => {
                      // console.log(res.data.error);
                      if(res.data.data){
            this.$toast.open({
            position: "top-right",
            message:
             "Connection Successful",
            type: "success",
            duration: 3000,
          });
          this.save_button = true,
          this.connection_button = false

          }
          if(res.data.woocommerce_error){
            this.$toast.open({
            position: "top-right",
            message: res.data.woocommerce_error,
            type: "error",
            duration: 7000,
          });
           
          }

          if(res.data.error){
            this.$toast.open({
            position: "top-right",
            message: "Connection Failed",
            type: "error",
            duration: 3000,
          });
            
          }

                    }).catch(err => {
                      this.$toast.open({
            position: "top-right",
            message: "Connection Failed",
            type: "error",
            duration: 3000,
          });
                        // console.log(err);
                    })
                }
      // console.log(this.online_store_name);
      // byMethod("post", '/api/ecommerce' ,this.form).then(
      //   (res) => {
      //     if(res.data.data){
      //       this.$toast.open({
      //       position: "top-right",
      //       message:
      //        "Connection Successful",
      //       type: "success",
      //       duration: 3000,
      //     });
      //     this.save_button = true,
      //     this.connection_button = false

      //     }
      //     if(res.data.woocommerce_error){
      //       this.$toast.open({
      //       position: "top-right",
      //       message: res.data.woocommerce_error,
      //       type: "error",
      //       duration: 7000,
      //     });
           
      //     }

      //     if(res.data.error){
      //       this.$toast.open({
      //       position: "top-right",
      //       message: "Connection Failed",
      //       type: "error",
      //       duration: 3000,
      //     });
            
      //     }
         
          
      //   }
      // )
    },
    couriertabs() {
        (this.email = false), (this.sms = false), (this.courier = true);
        console.log(this.company_id);
        if(isNaN(this.company_id)){
            this.$toast.open({
                position: "top-right",
                message:"Please Select Company First",
                
                type: "error",
                duration: 3000,
            });
        }
        else{
            this.storereturn(this.company_id);
        }
    },

    smstabs() {
      (this.email = false),
        (this.courier = false),
        (this.sms = true),
        (this.key = "sms_settings");
      this.returns(this.company_id);
    },

    emailtabs() {
      (this.sms = false),
        (this.courier = false),
        (this.email = true),
        (this.key = "email_settings");
      this.returns(this.company_id);
    },

    onCompany(e) {
      // console.log(e)
      const company = e;
      console.log(company);
      this.form.company = company;
      this.form.company_id = company.id;
      this.company_id = company.id
      this.returns(this.form.company_id);
    },
    save_store_data(){
     
      // byMethod("post", `/api/stores?store_id=${this.store_id}&company_id=${this.company_id}$name=${this.name}`  , this.data)
      byMethod("put", `/api/stores/${this.store_id}` , this.form)

        .then((res) => {
          
        })
    },

    create_store(stores){
      // console.log(stores);
      this.store_id = stores.id
      this.form.company_id = this.company_id
      this.form.store_id = stores.id
      this.form.name = stores.name
      this.form.location = stores.location
      this.form.api_key = stores.api_key
      this.form.api_secret = stores.api_secret
      this.form.store_address = stores.store_address
      this.form.word_address = stores.word_address
      this.form.access_token = stores.access_token
      // console.log(this.from.access_token);
    },
    company_data() {
      byMethod("get","/api/company").then(
        (res) => {
           
        }
      );
    },
    returns(e) {
      byMethod("get", `/api/settings/create?key=${this.key}&company=${e}`).then(
        (res) => {
          (this.show_company_data = true), this.setData(res);
        }
      );
    },

    storereturn(e) {
        byMethod("get", `/api/stores_data?company_id=${e}`).then(
            (res) => {
                console.log(res.data.data.data, 'abc');
                this.stores_data = res.data.data.data;
            }
        );
    },

    setData(res) {
      // console.log(res);
      this.form = res.data.form;
      if (this.$route.meta.mode === "edit") {
        this.store = `/api/${this.small}/${this.$route.params.id}?_method=PUT`;
        this.title = "Edit";
        this.message = `${this.capital} has been updated`;
      }
      this.show = true;
    },

    formSubmitted() {
      this.form.selectedPermissions = this.selectedPermissions;
      byMethod(this.method, this.store, this.form)
        .then((res) => {
          this.successfull(res);
          this.$toast.open({
            position: "top-right",
            message:
              this.mode === "edit"
                ? "Update Successfully"
                : "Create Successfully",
            type: "success",
            duration: 3000,
          });
        })
        .catch((err) => {
          this.error = err.response.data.errors;
          this.$toast.open({
            position: "top-right",
            message: "Error",
            type: "error",
            duration: 3000,
          });
          // console.log(err);
        });
    },

    savejson(e) {
      byMethod("post", `/api/global_settings?value=${e}&company_id=${this.company_id}`  , this.form)
        .then((res) => {
          
          this.$toast.open({
            position: "top-right",
            message:  "Success",
            type: "success",
            duration: 3000,
          });
        })
        .catch((err) => {
          this.error = err.response.data.errors;
          this.$toast.open({
            position: "top-right",
            message: "Error",
            type: "error",
            duration: 3000,
          });
          // console.log(err);
        });
    },
    successfull(res) {
      this.$router.push({ path: `${this.resource}` });
    },
  },
};
</script>

<style scoped>
.radio-inputs {
  display: flex;
  /* justify-content: center; */
  align-items: center;
  max-width: 350px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.radio-inputs > * {
  margin: 6px;
}

.radio-input:checked + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color: #2260ff;
}

.radio-input:checked + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
  background-color: #2260ff;
  border-color: #2260ff;
}

.radio-input:checked + .radio-tile .radio-icon svg {
  fill: #2260ff;
}

.radio-input:checked + .radio-tile .radio-label {
  color: #2260ff;
}

.radio-input:focus + .radio-tile {
  border-color: #2260ff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
}

.radio-input:focus + .radio-tile:before {
  transform: scale(1);
  opacity: 1;
}

.radio-tile {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 70px;
  min-height: 70px;
  border-radius: 0.5rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  transition: 0.15s ease;
  cursor: pointer;
  position: relative;
}

.radio-tile:before {
  content: "";
  position: absolute;
  display: block;
  width: 0.75rem;
  height: 0.75rem;
  border: 2px solid #b5bfd9;
  background-color: #fff;
  border-radius: 50%;
  top: 0.25rem;
  left: 0.25rem;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
}

.radio-tile:hover {
  border-color: #2260ff;
}

.radio-tile:hover:before {
  transform: scale(1);
  opacity: 1;
}
.radio-icon svg {
  width: 2rem;
  height: 2rem;
  fill: #494949;
}

.radio-label {
  color: #707070;
  transition: 0.375s ease;
  text-align: center;
  font-size: 13px;
}

.radio-input {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.card {
  position: relative;
  width: 70px;
  height: 70px;
  background-color: #f2f2f2;
  border-radius: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  perspective: 1000px;
  box-shadow: 0 0 0 5px #ffffff80;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card svg {
  width: 48px;
  fill: #333333;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px rgba(255, 255, 255, 0.2);
}

.card__content {
  position: absolute;
  
  left: 0;
  width: 100%;
  height: 100%;
  padding: 10px;
  box-sizing: border-box;
  background-color: #f2f2f2;
  transform: rotateX(-90deg);
  transform-origin: bottom;
}

.card:hover .card__content {
  transform: rotateX(0deg);
}

.card__title {
  margin: 0;
  font-size: 12px;
  color: #3985b1;
  font-weight: 700;
}

.card:hover svg {
  scale: 0;
}

.card__description {
  margin: 10px 0 0;
  font-size: 8px;
  font-weight: bold;
  color: #0c0c0c;
  line-height: 1.4;
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}
.coins {
  font-size: 80px;
  width: 0.1em;
  height: 1em;
  background: linear-gradient(49deg, rgb(91, 255, 154) 0%, rgb(29, 194, 65) 31%, rgb(4, 143, 4) 71%);
  margin-left:10%;
  animation: rotate_4001510 7s infinite linear;
  transform-style: preserve-3d;
}
.coin {
  font-size: 80px;
  width: 0.1em;
  height: 1em;
  background: linear-gradient(49deg, rgba(37,40,119,1) 0%, rgba(31,31,88,1) 31%, rgba(11,37,37,1) 71%);
  margin-left:10%;
  animation: rotate_4001510 7s infinite linear;
  transform-style: preserve-3d;
}

.coin .side, .coin:before, .coin:after {
  content: "";
  position: absolute;
  width: 1em;
  height: 1em;
  overflow: hidden;
  border-radius: 50%;
  right: -0.4em;
  text-align: center;
  line-height: 1;
  transform: rotateY(-90deg);
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.coin .tails, .coin:after {
  left: -0.4em;
  transform: rotateY(90deg);
}

.coins .side, .coins:before, .coins:after {
  content: "";
  position: absolute;
  width: 1em;
  height: 1em;
  overflow: hidden;
  border-radius: 50%;
  right: -0.4em;
  text-align: center;
  line-height: 1;
  transform: rotateY(-90deg);
  -moz-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.coins .tails, .coins:after {
  left: -0.4em;
  transform: rotateY(90deg);
}


.coin:before, .coin:after {
  background: linear-gradient(49deg, rgba(37,40,119,1) 0%, rgba(31,31,88,1) 31%, rgba(11,37,37,1) 71%);
  backface-visibility: hidden;
  transform: rotateY(90deg);
}
.coins:before, .coins:after {
  background: linear-gradient(49deg, rgb(91, 255, 154) 0%, rgb(29, 194, 65) 31%, rgb(4, 143, 4) 71%);
  backface-visibility: hidden;
  transform: rotateY(90deg);
}

.coin:after {
  transform: rotateY(-90deg);
}
.coins:after {
  transform: rotateY(-90deg);
}


@keyframes rotate_4001510 {
  100% {
    transform: rotateY(360deg);
  }
}
/* 
.svg_back {
  transform: scaleX(-1);
} */


/* === removing default button style ===*/
.buttons {
  margin: 0;
  height: auto;
  background: transparent;
  padding: 0;
  border: none;
}

/* button styling */
.buttons {
  --border-right: 6px;
  --text-stroke-color: rgba(255,255,255,0.6);
  --animation-color: #37FF8B;
  --fs-size: 1.5em;
  letter-spacing: 3px;
  text-decoration: none;
  font-size: var(--fs-size);
  font-family: "Arial";
  position: relative;
  text-transform: uppercase;
  color: transparent;
  -webkit-text-stroke: 1px var(--text-stroke-color);
}
/* this is the text, when you hover on button */
.hover-text {
  position: absolute;
  box-sizing: border-box;
  content: attr(data-text);
  color: var(--animation-color);
  width: 0%;
  inset: 0;
  border-right: var(--border-right) solid var(--animation-color);
  overflow: hidden;
  transition: 0.5s;
  -webkit-text-stroke: 1px var(--animation-color);
}
/* hover */
.buttons:hover .hover-text {
  width: 100%;
  filter: drop-shadow(0 0 23px var(--animation-color))
}



</style>
