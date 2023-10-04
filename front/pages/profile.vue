<script  setup>
definePageMeta(
  {
    layout: 'profile',
  }
);
</script>

<template>
  <div class="bg-gray-50 w-full mx-5 grid md:grid-cols-6 gap-4 mt-8 ">
    <!-- Welcome Card -->
    <ProfileHeaderCard />


    <!-- Main Card -->
    <ProfileMainCard />

    <!-- Side Card -->
    <div class="col-span-2  flex flex-col gap-y-4">
      <!-- Video Intro -->
      <div class="bg-white rounded shadow mt-6 md:mt-0">
        <div class="px-5 py-4">
          <p class="font-semibold text-gray-700">Video Introduction</p>
        </div>
        <div class="border-t  w-full">
          <div class=" ">

            <iframe class="aspect-video w-full rounded-b" width="300" height="190"
              src="https://www.youtube.com/embed/RbotVOelVRQ" title="Applicant not following best practices"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <!-- Profile Completion 1-->

      <div class="bg-white rounded shadow mt-6 md:mt-0">
        <div class="px-5 py-4">
          <p class="font-semibold text-gray-700">Profile Completion</p>
          <div class="flex items-center">
            <div class="overflow-hidden text-xs flex rounded-full bg-gray-200 w-10/12"
              style="height: 8px;">
              <div
                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 --over-50-below-70"
                style="width: 100%;"></div>
            </div>
            <p class="pl-2 font-semibold text-gray-600 w-1/12">100%</p>
          </div>
        </div>
        <div class="  px-5 py-4">
          <div class="flex items-center w-full text-gray-700 justify-center">
            <span class="font-semibold  text-green-500 text-center">Well done, John
            </span>
          </div>
          <div class="mt-3">
            <div class=" flex justify-center  ">
              <img class="w-20" src="~/assets/icon/medal.svg" alt="">
            </div>

            <p class=" mt-3 font-normal text-gray-800">You have one of the strongest
              professional profile in our talent pool.
              Expect progress on your application at
              any time soon.</p>

          </div>
        </div>
      </div>

      <!-- Profile Completion 2-->
      <div   class="bg-white rounded shadow mt-6 md:mt-0">
        <div  class="px-5 py-4">
          <p  class="font-semibold text-gray-700">Profile Completion</p>
          <div  class="flex items-center">
            <div class="overflow-hidden text-xs flex rounded-full bg-gray-200 w-10/12"
              style="height: 8px;">
              <div
                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-orange-500 --over-50-below-70"
              style="width: 50%;"></div>
          </div>
          <p class="pl-2 font-semibold text-gray-600 w-1/12">50%</p>
        </div>
      </div>
      <div  class="border-t relative px-5 py-4">
        <div  class="flex items-center w-full text-gray-700"><span 
            class="font-semibold mr-auto">Hide Recommendations</span><svg  aria-hidden="true"
            focusable="false" data-prefix="fal" data-icon="chevron-up" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512" class="cursor-pointer svg-inline--fa fa-chevron-up fa-fw">
            <path  fill="currentColor"
              d="M244.7 116.7c6.2-6.2 16.4-6.2 22.6 0l192 192c6.2 6.2 6.2 16.4 0 22.6s-16.4 6.2-22.6 0L256 150.6 75.3 331.3c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l192-192z"
              class=""></path>
          </svg></div>
        <div  class="mt-3">
          <p  class="text-gray-700 mb-1">Fill-up the following items to strengthen your profile. This
            can help us in matching your profile and increase your chances of landing into your desired role.</p>
          
          <p  class="text-base mt-3 font-semibold text-gray-800">Others</p>
          <ul  class="text-base ml-6 list-disc text-gray-700">
            <li >Share <span 
                class="text-primaryProfile font-semibold clickable">Date of Birth</span>
              </li>
              <li >Specify <span 
                class="text-primaryProfile font-semibold clickable">Current Monthly Salary</span>
              </li>
            <li >Add at least one (1) 
              <span class="text-primaryProfile font-semibold clickable">Character Reference</span>
              </li>
            <li >Add <span 
                class="text-primaryProfile font-semibold clickable">Current Address</span>
              </li>

              <li >Add atleast five(5) items in <span 
                class="text-primaryProfile font-semibold clickable">Others Skills</span>
              </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div></template>

<style scoped></style>
