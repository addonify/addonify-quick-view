"use strict";(self.webpackChunkaddonify_quick_view=self.webpackChunkaddonify_quick_view||[]).push([[522],{1274:(e,t,n)=>{n.d(t,{Z:()=>i});var a=n(3645),o=n.n(a)()((function(e){return e[1]}));o.push([e.id,'.unsupported-control-text{font-size:14px}.adfy-button.fake-button.forward-to-doc-link{fill:var(--addonify_primary_color);color:var(--addonify_primary_color);font-size:14px}.adfy-button.fake-button.forward-to-doc-link:after,.adfy-button.fake-button.forward-to-doc-link:before{bottom:-5px;content:"";height:2px}.adfy-button.fake-button.forward-to-doc-link:after{background-color:var(--addonify_primary_color);content:""}.adfy-button.fake-button.forward-to-doc-link:hover{fill:var(--addonify_base_text_color);color:var(--addonify_base_text_color)}.adfy-button.fake-button.forward-to-doc-link:hover:after,.adfy-button.fake-button.forward-to-doc-link:hover:before{background-color:var(--addonify_base_text_color);content:""}',""]);const i=o},2740:(e,t,n)=>{n.d(t,{Z:()=>i});var a=n(3645),o=n.n(a)()((function(e){return e[1]}));o.push([e.id,".adfy-options .el-color-picker__color,.adfy-options .el-color-picker__color-inner,.adfy-options .el-color-picker__trigger{border-radius:100%}.adfy-options .el-color-picker__color{border:none}.adfy-options .el-color-picker__trigger{border:2px dotted #bbb;height:36px;padding:5px;width:36px}",""]);const i=o},1777:(e,t,n)=>{n.d(t,{Z:()=>i});var a=n(3645),o=n.n(a)()((function(e){return e[1]}));o.push([e.id,".wp-admin .el-select-dropdown__item.selected{font-weight:400}",""]);const i=o},2306:(e,t,n)=>{n.d(t,{Z:()=>i});var a=n(3645),o=n.n(a)()((function(e){return e[1]}));o.push([e.id,".adfy-options .el-textarea__inner{display:block;font-family:monospace;min-height:200px;padding:15px;width:100%}",""]);const i=o},7218:()=>{},2403:(e,t,n)=>{var a=n(4865),o=n(1575),i=n(9509),l=(n(3325),lodash),r=l.isEqual,s=l.cloneDeep,c=wp.apiFetch,u=adfy_wp_locolizer.rest_namespace,d={},f=(0,o.Q_)({id:"Options",state:function(){return{data:{},options:{},message:"",isLoading:!0,isSaving:!1,needSave:!1,errors:""}},getters:{needSave:function(e){return!r(e.options,d)}},actions:{fetchOptions:function(){var e=this;c({path:u+"/get_options",method:"GET"}).then((function(t){var n=t.settings_values;e.data=t.tabs,e.options=n,d=s(n),e.isLoading=!1}))},handleUpdateOptions:function(){var e={},t=this.options;Object.keys(t).map((function(n){r(t[n],d[n])||(e[n]=t[n])})),this.updateOptions(e)},updateOptions:function(e){var t=this;this.isSaving=!0,c({path:u+"/update_options",method:"POST",data:{settings_values:e}}).then((function(e){t.isSaving=!1,t.message=e.message,!0===e.success?i.z8.success({message:t.message,offset:50,duration:3e3}):i.z8.error({message:t.message,offset:50,duration:3e3}),t.fetchOptions()}))}}}),p={class:"adfy-header"},m={class:"adfy-row"},v={class:"adfy-col start"},C={class:"branding"},_=(0,a._)("svg",{width:"133",height:"42",viewBox:"0 0 133 42",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[(0,a._)("path",{d:"M53.639 28.325C53.837 27.907 54.1413 27.566 54.552 27.302C54.97 27.038 55.4613 26.906 56.026 26.906C56.576 26.906 57.0673 27.0343 57.5 27.291C57.9327 27.5403 58.27 27.8997 58.512 28.369C58.7613 28.831 58.886 29.37 58.886 29.986C58.886 30.602 58.7613 31.1447 58.512 31.614C58.27 32.0833 57.929 32.4463 57.489 32.703C57.0563 32.9597 56.5687 33.088 56.026 33.088C55.454 33.088 54.959 32.9597 54.541 32.703C54.1303 32.439 53.8297 32.098 53.639 31.68V33H52.88V24.86H53.639V28.325ZM58.105 29.986C58.105 29.4873 58.006 29.0583 57.808 28.699C57.6173 28.3323 57.3533 28.0537 57.016 27.863C56.6787 27.6723 56.2973 27.577 55.872 27.577C55.4613 27.577 55.0837 27.676 54.739 27.874C54.4017 28.072 54.134 28.3543 53.936 28.721C53.738 29.0877 53.639 29.513 53.639 29.997C53.639 30.481 53.738 30.9063 53.936 31.273C54.134 31.6397 54.4017 31.922 54.739 32.12C55.0837 32.318 55.4613 32.417 55.872 32.417C56.2973 32.417 56.6787 32.3217 57.016 32.131C57.3533 31.933 57.6173 31.6507 57.808 31.284C58.006 30.91 58.105 30.4773 58.105 29.986ZM65.8029 26.994L62.2389 35.827H61.4359L62.6019 32.967L60.1379 26.994H60.9849L63.0309 32.12L65.0109 26.994H65.8029ZM70.6135 29.986C70.6135 29.37 70.7345 28.831 70.9765 28.369C71.2259 27.8997 71.5669 27.5403 71.9995 27.291C72.4395 27.0343 72.9345 26.906 73.4845 26.906C74.0565 26.906 74.5479 27.038 74.9585 27.302C75.3765 27.566 75.6772 27.9033 75.8605 28.314V26.994H76.6305V33H75.8605V31.669C75.6699 32.0797 75.3655 32.4207 74.9475 32.692C74.5369 32.956 74.0455 33.088 73.4735 33.088C72.9309 33.088 72.4395 32.9597 71.9995 32.703C71.5669 32.4463 71.2259 32.0833 70.9765 31.614C70.7345 31.1447 70.6135 30.602 70.6135 29.986ZM75.8605 29.997C75.8605 29.513 75.7615 29.0877 75.5635 28.721C75.3655 28.3543 75.0942 28.072 74.7495 27.874C74.4122 27.676 74.0382 27.577 73.6275 27.577C73.2022 27.577 72.8209 27.6723 72.4835 27.863C72.1462 28.0537 71.8785 28.3323 71.6805 28.699C71.4899 29.0583 71.3945 29.4873 71.3945 29.986C71.3945 30.4773 71.4899 30.91 71.6805 31.284C71.8785 31.6507 72.1462 31.933 72.4835 32.131C72.8209 32.3217 73.2022 32.417 73.6275 32.417C74.0382 32.417 74.4122 32.318 74.7495 32.12C75.0942 31.922 75.3655 31.6397 75.5635 31.273C75.7615 30.9063 75.8605 30.481 75.8605 29.997ZM78.5864 29.986C78.5864 29.37 78.7111 28.831 78.9604 28.369C79.2097 27.8997 79.5507 27.5403 79.9834 27.291C80.4234 27.0343 80.9184 26.906 81.4684 26.906C81.9964 26.906 82.4731 27.0343 82.8984 27.291C83.3237 27.5477 83.6354 27.8813 83.8334 28.292V24.86H84.6034V33H83.8334V31.658C83.6501 32.076 83.3494 32.4207 82.9314 32.692C82.5134 32.956 82.0221 33.088 81.4574 33.088C80.9074 33.088 80.4124 32.9597 79.9724 32.703C79.5397 32.4463 79.1987 32.0833 78.9494 31.614C78.7074 31.1447 78.5864 30.602 78.5864 29.986ZM83.8334 29.997C83.8334 29.513 83.7344 29.0877 83.5364 28.721C83.3384 28.3543 83.0671 28.072 82.7224 27.874C82.3851 27.676 82.0111 27.577 81.6004 27.577C81.1751 27.577 80.7937 27.6723 80.4564 27.863C80.1191 28.0537 79.8514 28.3323 79.6534 28.699C79.4627 29.0583 79.3674 29.4873 79.3674 29.986C79.3674 30.4773 79.4627 30.91 79.6534 31.284C79.8514 31.6507 80.1191 31.933 80.4564 32.131C80.7937 32.3217 81.1751 32.417 81.6004 32.417C82.0111 32.417 82.3851 32.318 82.7224 32.12C83.0671 31.922 83.3384 31.6397 83.5364 31.273C83.7344 30.9063 83.8334 30.481 83.8334 29.997ZM86.5593 29.986C86.5593 29.37 86.6839 28.831 86.9333 28.369C87.1826 27.8997 87.5236 27.5403 87.9563 27.291C88.3963 27.0343 88.8913 26.906 89.4413 26.906C89.9693 26.906 90.4459 27.0343 90.8713 27.291C91.2966 27.5477 91.6083 27.8813 91.8063 28.292V24.86H92.5763V33H91.8063V31.658C91.6229 32.076 91.3223 32.4207 90.9043 32.692C90.4863 32.956 89.9949 33.088 89.4303 33.088C88.8803 33.088 88.3853 32.9597 87.9453 32.703C87.5126 32.4463 87.1716 32.0833 86.9223 31.614C86.6803 31.1447 86.5593 30.602 86.5593 29.986ZM91.8063 29.997C91.8063 29.513 91.7073 29.0877 91.5093 28.721C91.3113 28.3543 91.0399 28.072 90.6953 27.874C90.3579 27.676 89.9839 27.577 89.5733 27.577C89.1479 27.577 88.7666 27.6723 88.4293 27.863C88.0919 28.0537 87.8243 28.3323 87.6263 28.699C87.4356 29.0583 87.3403 29.4873 87.3403 29.986C87.3403 30.4773 87.4356 30.91 87.6263 31.284C87.8243 31.6507 88.0919 31.933 88.4293 32.131C88.7666 32.3217 89.1479 32.417 89.5733 32.417C89.9839 32.417 90.3579 32.318 90.6953 32.12C91.0399 31.922 91.3113 31.6397 91.5093 31.273C91.7073 30.9063 91.8063 30.481 91.8063 29.997ZM97.5131 33.088C96.9484 33.088 96.4388 32.9633 95.9841 32.714C95.5368 32.4573 95.1811 32.098 94.9171 31.636C94.6604 31.1667 94.5321 30.6203 94.5321 29.997C94.5321 29.3737 94.6641 28.831 94.9281 28.369C95.1921 27.8997 95.5514 27.5403 96.0061 27.291C96.4608 27.0343 96.9704 26.906 97.5351 26.906C98.0998 26.906 98.6094 27.0343 99.0641 27.291C99.5261 27.5403 99.8854 27.8997 100.142 28.369C100.406 28.831 100.538 29.3737 100.538 29.997C100.538 30.613 100.406 31.1557 100.142 31.625C99.8781 32.0943 99.5151 32.4573 99.0531 32.714C98.5911 32.9633 98.0778 33.088 97.5131 33.088ZM97.5131 32.417C97.9091 32.417 98.2758 32.329 98.6131 32.153C98.9504 31.9697 99.2218 31.6983 99.4271 31.339C99.6398 30.9723 99.7461 30.525 99.7461 29.997C99.7461 29.469 99.6434 29.0253 99.4381 28.666C99.2328 28.2993 98.9614 28.028 98.6241 27.852C98.2868 27.6687 97.9201 27.577 97.5241 27.577C97.1281 27.577 96.7614 27.6687 96.4241 27.852C96.0868 28.028 95.8154 28.2993 95.6101 28.666C95.4121 29.0253 95.3131 29.469 95.3131 29.997C95.3131 30.525 95.4121 30.9723 95.6101 31.339C95.8154 31.6983 96.0831 31.9697 96.4131 32.153C96.7504 32.329 97.1171 32.417 97.5131 32.417ZM105.308 26.884C106.026 26.884 106.613 27.1077 107.068 27.555C107.522 27.995 107.75 28.6367 107.75 29.48V33H106.991V29.568C106.991 28.9153 106.826 28.4167 106.496 28.072C106.173 27.7273 105.729 27.555 105.165 27.555C104.585 27.555 104.123 27.7383 103.779 28.105C103.434 28.4717 103.262 29.0107 103.262 29.722V33H102.492V26.994H103.262V28.017C103.452 27.6503 103.727 27.3717 104.087 27.181C104.446 26.983 104.853 26.884 105.308 26.884ZM110.388 25.861C110.234 25.861 110.102 25.806 109.992 25.696C109.882 25.586 109.827 25.4503 109.827 25.289C109.827 25.1277 109.882 24.9957 109.992 24.893C110.102 24.783 110.234 24.728 110.388 24.728C110.542 24.728 110.674 24.783 110.784 24.893C110.894 24.9957 110.949 25.1277 110.949 25.289C110.949 25.4503 110.894 25.586 110.784 25.696C110.674 25.806 110.542 25.861 110.388 25.861ZM110.773 26.994V33H110.003V26.994H110.773ZM115.431 27.643H114.034V33H113.264V27.643H112.428V26.994H113.264V26.576C113.264 25.9233 113.429 25.443 113.759 25.135C114.097 24.827 114.639 24.673 115.387 24.673V25.333C114.889 25.333 114.537 25.4283 114.331 25.619C114.133 25.8097 114.034 26.1287 114.034 26.576V26.994H115.431V27.643ZM122.143 26.994L118.579 35.827H117.776L118.942 32.967L116.478 26.994H117.325L119.371 32.12L121.351 26.994H122.143Z",fill:"#313131"}),(0,a._)("path",{d:"M54.3903 14.7131H56.0891L56.9432 15.8118L57.7834 16.7905L59.3668 18.7756H57.5018L56.4123 17.4368L55.8537 16.6428L54.3903 14.7131ZM59.5099 13.2727C59.5099 14.3037 59.3145 15.1809 58.9237 15.9041C58.5359 16.6274 58.0065 17.1798 57.3356 17.5614C56.6677 17.94 55.9168 18.1293 55.0827 18.1293C54.2425 18.1293 53.4885 17.9384 52.8207 17.5568C52.1528 17.1752 51.625 16.6228 51.2372 15.8995C50.8494 15.1763 50.6555 14.3007 50.6555 13.2727C50.6555 12.2417 50.8494 11.3646 51.2372 10.6413C51.625 9.91809 52.1528 9.36719 52.8207 8.98864C53.4885 8.60701 54.2425 8.41619 55.0827 8.41619C55.9168 8.41619 56.6677 8.60701 57.3356 8.98864C58.0065 9.36719 58.5359 9.91809 58.9237 10.6413C59.3145 11.3646 59.5099 12.2417 59.5099 13.2727ZM57.4833 13.2727C57.4833 12.6049 57.3833 12.0417 57.1832 11.5831C56.9863 11.1245 56.7077 10.7768 56.3477 10.5398C55.9876 10.3028 55.5659 10.1843 55.0827 10.1843C54.5996 10.1843 54.1779 10.3028 53.8178 10.5398C53.4577 10.7768 53.1777 11.1245 52.9776 11.5831C52.7807 12.0417 52.6822 12.6049 52.6822 13.2727C52.6822 13.9406 52.7807 14.5038 52.9776 14.9624C53.1777 15.4209 53.4577 15.7687 53.8178 16.0057C54.1779 16.2427 54.5996 16.3612 55.0827 16.3612C55.5659 16.3612 55.9876 16.2427 56.3477 16.0057C56.7077 15.7687 56.9863 15.4209 57.1832 14.9624C57.3833 14.5038 57.4833 13.9406 57.4833 13.2727ZM67.0905 8.54545H69.0895V14.6854C69.0895 15.3748 68.9248 15.978 68.5955 16.495C68.2693 17.0121 67.8122 17.4152 67.2244 17.7045C66.6366 17.9908 65.9518 18.1339 65.1701 18.1339C64.3853 18.1339 63.699 17.9908 63.1111 17.7045C62.5233 17.4152 62.0663 17.0121 61.74 16.495C61.4138 15.978 61.2507 15.3748 61.2507 14.6854V8.54545H63.2496V14.5146C63.2496 14.8746 63.3281 15.1947 63.4851 15.4748C63.6451 15.7549 63.8698 15.9749 64.1591 16.1349C64.4484 16.295 64.7854 16.375 65.1701 16.375C65.5579 16.375 65.8949 16.295 66.1811 16.1349C66.4704 15.9749 66.6935 15.7549 66.8505 15.4748C67.0105 15.1947 67.0905 14.8746 67.0905 14.5146V8.54545ZM72.993 8.54545V18H70.9941V8.54545H72.993ZM83.2396 11.8555H81.2176C81.1807 11.5939 81.1053 11.3615 80.9914 11.1584C80.8775 10.9522 80.7313 10.7768 80.5528 10.6321C80.3743 10.4875 80.1681 10.3767 79.9342 10.2997C79.7034 10.2228 79.4526 10.1843 79.1817 10.1843C78.6924 10.1843 78.2661 10.3059 77.903 10.549C77.5398 10.7891 77.2582 11.1399 77.0581 11.6016C76.8581 12.0601 76.7581 12.6172 76.7581 13.2727C76.7581 13.9467 76.8581 14.513 77.0581 14.9716C77.2613 15.4302 77.5444 15.7764 77.9076 16.0103C78.2707 16.2442 78.6908 16.3612 79.1679 16.3612C79.4356 16.3612 79.6834 16.3258 79.9111 16.255C80.142 16.1842 80.3466 16.0811 80.5251 15.9457C80.7036 15.8072 80.8513 15.6394 80.9683 15.4425C81.0883 15.2455 81.1714 15.0208 81.2176 14.7685L83.2396 14.7777C83.1873 15.2116 83.0565 15.6302 82.8472 16.0334C82.641 16.4335 82.3625 16.792 82.0116 17.109C81.6638 17.4229 81.2484 17.6722 80.7652 17.8569C80.2851 18.0385 79.7419 18.1293 79.1356 18.1293C78.2923 18.1293 77.5383 17.9384 76.8735 17.5568C76.2118 17.1752 75.6886 16.6228 75.3039 15.8995C74.9223 15.1763 74.7314 14.3007 74.7314 13.2727C74.7314 12.2417 74.9253 11.3646 75.3131 10.6413C75.7009 9.91809 76.2272 9.36719 76.892 8.98864C77.5567 8.60701 78.3046 8.41619 79.1356 8.41619C79.6834 8.41619 80.1912 8.49313 80.659 8.64702C81.1299 8.8009 81.5469 9.02557 81.9101 9.32102C82.2732 9.6134 82.5687 9.97195 82.7964 10.3967C83.0272 10.8214 83.175 11.3076 83.2396 11.8555ZM84.933 18V8.54545H86.932V12.7141H87.0566L90.4589 8.54545H92.8549L89.3464 12.7788L92.8964 18H90.5051L87.9153 14.1129L86.932 15.3132V18H84.933ZM99.1328 8.54545L101.418 15.7287H101.506L103.795 8.54545H106.011L102.752 18H100.176L96.9123 8.54545H99.1328ZM109.408 8.54545V18H107.409V8.54545H109.408ZM111.313 18V8.54545H117.684V10.1935H113.312V12.4464H117.356V14.0945H113.312V16.3519H117.702V18H111.313ZM121.661 18L118.956 8.54545H121.139L122.704 15.1147H122.783L124.509 8.54545H126.379L128.101 15.1286H128.184L129.749 8.54545H131.933L129.227 18H127.279L125.479 11.8185H125.405L123.609 18H121.661Z",fill:"#313131"}),(0,a._)("rect",{width:"42",height:"42",rx:"4",fill:"url(#paint0_linear_3_14)"}),(0,a._)("path",{d:"M20.25 13.5C23.976 13.5 27 16.524 27 20.25C27 23.976 23.976 27 20.25 27C16.524 27 13.5 23.976 13.5 20.25C13.5 16.524 16.524 13.5 20.25 13.5ZM20.25 25.5C23.1503 25.5 25.5 23.1503 25.5 20.25C25.5 17.349 23.1503 15 20.25 15C17.349 15 15 17.349 15 20.25C15 23.1503 17.349 25.5 20.25 25.5ZM26.6138 25.5533L28.7355 27.6743L27.6743 28.7355L25.5533 26.6138L26.6138 25.5533V25.5533Z",fill:"white"}),(0,a._)("defs",null,[(0,a._)("linearGradient",{id:"paint0_linear_3_14",x1:"21",y1:"0",x2:"21",y2:"42",gradientUnits:"userSpaceOnUse"},[(0,a._)("stop",{"stop-color":"#DA0000"}),(0,a._)("stop",{offset:"1","stop-color":"#FF2C2C"})])])],-1),w={class:"adfy-col end"},y={class:"buttons"},h={href:"https://docs.addonify.com/kb/woocommerce-quick-view/",class:"adfy-button fake-button has-underline",target:"_blank"},g=["disabled","loading"],V=(0,a._)("span",{class:"loading-icon"},[(0,a._)("svg",{viewBox:"0 0 1024 1024",xmlns:"http://www.w3.org/2000/svg"},[(0,a._)("path",{fill:"currentColor",d:"M512 64a32 32 0 0 1 32 32v192a32 32 0 0 1-64 0V96a32 32 0 0 1 32-32zm0 640a32 32 0 0 1 32 32v192a32 32 0 1 1-64 0V736a32 32 0 0 1 32-32zm448-192a32 32 0 0 1-32 32H736a32 32 0 1 1 0-64h192a32 32 0 0 1 32 32zm-640 0a32 32 0 0 1-32 32H96a32 32 0 0 1 0-64h192a32 32 0 0 1 32 32zM195.2 195.2a32 32 0 0 1 45.248 0L376.32 331.008a32 32 0 0 1-45.248 45.248L195.2 240.448a32 32 0 0 1 0-45.248zm452.544 452.544a32 32 0 0 1 45.248 0L828.8 783.552a32 32 0 0 1-45.248 45.248L647.744 692.992a32 32 0 0 1 0-45.248zM828.8 195.264a32 32 0 0 1 0 45.184L692.992 376.32a32 32 0 0 1-45.248-45.248l135.808-135.808a32 32 0 0 1 45.248 0zm-452.544 452.48a32 32 0 0 1 0 45.248L240.448 828.8a32 32 0 0 1-45.248-45.248l135.808-135.808a32 32 0 0 1 45.248 0z"})])],-1);const S={__name:"Header",setup:function(e){var t=wp.i18n.__,n=f();return function(e,o){var i=(0,a.up)("router-link");return(0,a.wg)(),(0,a.iD)("header",p,[(0,a._)("div",m,[(0,a._)("div",v,[(0,a._)("div",C,[(0,a.Wm)(i,{class:"adfy-link",to:"/"},{default:(0,a.w5)((function(){return[_]})),_:1})])]),(0,a._)("div",w,[(0,a._)("div",y,[(0,a._)("a",h,(0,a.zw)((0,a.SU)(t)("Documentation","addonify-quick-view")),1),(0,a._)("button",{type:"submit",onClick:o[0]||(o[0]=function(e){return(0,a.SU)(n).handleUpdateOptions()}),class:"adfy-button",disabled:!(0,a.SU)(n).needSave,loading:(0,a.SU)(n).isSaving},[V,(0,a.Uk)(" "+(0,a.zw)((0,a.SU)(t)("Save Options","addonify-quick-view")),1)],8,g)])])])])}}};var b={class:"adfy-colopon"},k={class:"adfy-row"},U={class:"adfy-col left"},H={class:"text"},z={class:"version"},x={class:"adfy-col right"},L={class:"text"},Z={href:"https://wordpress.org/plugins/addonify-quick-view/#reviews",class:"adfy-link",target:"_blank"},j=(0,a.uE)('<span class="icon"><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i><i class="dashicons dashicons-star-filled"></i></span> :) ',2);const M={__name:"Footer",setup:function(e){var t=wp.i18n.__,n=adfy_wp_locolizer.version_number,o=(new Date).getFullYear();return function(e,i){return(0,a.wg)(),(0,a.iD)("footer",b,[(0,a._)("div",k,[(0,a._)("div",U,[(0,a._)("p",H,[(0,a.Uk)(" © 2020 - "+(0,a.zw)((0,a.SU)(o))+" Addonify Quick View ",1),(0,a._)("span",z,(0,a.zw)((0,a.SU)(t)("Version","addonify-quick-view"))+": "+(0,a.zw)((0,a.SU)(n)),1)])]),(0,a._)("div",x,[(0,a._)("p",L,[(0,a._)("a",Z,[(0,a.Uk)((0,a.zw)((0,a.SU)(t)("Rate","addonify-quick-view"))+" ",1),j])])])])])}}},D={__name:"App",setup:function(e){return function(e,t){var n=(0,a.up)("router-view");return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a.Wm)(S),(0,a.Wm)(n),(0,a.Wm)(M)],64)}}};var K=n(2119),q={class:"adfy-loading"},O=[(0,a._)("span",{class:"pulse"},null,-1)];const W={},F=(0,n(3744).Z)(W,[["render",function(e,t){return(0,a.wg)(),(0,a.iD)("section",q,O)}]]);var A={class:"adfy-navigation"},N={class:"navigation"},B=(0,a._)("span",{class:"icon"},[(0,a._)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},[(0,a._)("path",{fill:"none",d:"M0 0h24v24H0z"}),(0,a._)("path",{d:"M2.132 13.63a9.942 9.942 0 0 1 0-3.26c1.102.026 2.092-.502 2.477-1.431.385-.93.058-2.004-.74-2.763a9.942 9.942 0 0 1 2.306-2.307c.76.798 1.834 1.125 2.764.74.93-.385 1.457-1.376 1.43-2.477a9.942 9.942 0 0 1 3.262 0c-.027 1.102.501 2.092 1.43 2.477.93.385 2.004.058 2.763-.74a9.942 9.942 0 0 1 2.307 2.306c-.798.76-1.125 1.834-.74 2.764.385.93 1.376 1.457 2.477 1.43a9.942 9.942 0 0 1 0 3.262c-1.102-.027-2.092.501-2.477 1.43-.385.93-.058 2.004.74 2.763a9.942 9.942 0 0 1-2.306 2.307c-.76-.798-1.834-1.125-2.764-.74-.93.385-1.457 1.376-1.43 2.477a9.942 9.942 0 0 1-3.262 0c.027-1.102-.501-2.092-1.43-2.477-.93-.385-2.004-.058-2.763.74a9.942 9.942 0 0 1-2.307-2.306c.798-.76 1.125-1.834.74-2.764-.385-.93-1.376-1.457-2.477-1.43zM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"})])],-1),Y=(0,a._)("span",{class:"icon"},[(0,a._)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},[(0,a._)("path",{fill:"none",d:"M0 0h24v24H0z"}),(0,a._)("path",{d:"M4 3h16a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm2 9h6a1 1 0 0 1 1 1v3h1v6h-4v-6h1v-2H5a1 1 0 0 1-1-1v-2h2v1zm11.732 1.732l1.768-1.768 1.768 1.768a2.5 2.5 0 1 1-3.536 0z"})])],-1),I=(0,a._)("span",{class:"icon"},[(0,a._)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},[(0,a._)("path",{fill:"none",d:"M0 0h24v24H0z"}),(0,a._)("path",{d:"M13 16.938V19h5v2H6v-2h5v-2.062A8.001 8.001 0 0 1 4 9V3h16v6a8.001 8.001 0 0 1-7 7.938zM1 5h2v4H1V5zm20 0h2v4h-2V5z"})])],-1);const E={__name:"Navigation",setup:function(e){var t=wp.i18n.__;return function(e,n){var o=(0,a.up)("router-link");return(0,a.wg)(),(0,a.iD)("nav",A,[(0,a._)("ul",N,[(0,a._)("li",null,[(0,a.Wm)(o,{to:"/"},{default:(0,a.w5)((function(){return[B,(0,a.Uk)(" "+(0,a.zw)((0,a.SU)(t)("Settings","addonify-quick-view")),1)]})),_:1})]),(0,a._)("li",null,[(0,a.Wm)(o,{to:"/styles"},{default:(0,a.w5)((function(){return[Y,(0,a.Uk)(" "+(0,a.zw)((0,a.SU)(t)("Design","addonify-quick-view")),1)]})),_:1})]),(0,a._)("li",null,[(0,a.Wm)(o,{to:"/products"},{default:(0,a.w5)((function(){return[I,(0,a.Uk)(" "+(0,a.zw)((0,a.SU)(t)("Products","addonify-quick-view")),1)]})),_:1})])])])}}};var T=["id"];const P={__name:"Form",props:{divId:String,className:String},setup:function(e){var t=e;return function(e,n){return(0,a.wg)(),(0,a.iD)("form",{id:t.divId,class:(0,a.C_)(["adfy-form",t.className]),onSubmit:n[0]||(n[0]=(0,a.iM)((function(){}),["prevent"]))},[(0,a.WI)(e.$slots,"default")],42,T)}}};var G={key:0,class:"option-box-title"};const $={__name:"SectionTitle",props:{section:Object,sectionkey:String},setup:function(e){var t=e;return function(e,n){return t.section.title?((0,a.wg)(),(0,a.iD)("h3",G,(0,a.zw)(t.section.title),1)):(0,a.kq)("",!0)}}};var Q=n(8643),R=(n(2094),n(5781));const X={__name:"Switch",props:{modelValue:[Boolean,Number,String]},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(Q.OX),{modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null}),size:"large","inline-prompt":"","active-icon":(0,a.SU)(R.JrY),"inactive-icon":(0,a.SU)(R.x8P)},null,8,["modelValue","active-icon","inactive-icon"])}}};var J=n(3258);n(6152);const ee={__name:"Text",props:{modelValue:String,placeholder:String},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=wp.i18n.__,l=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(J.EZ),{modelValue:(0,a.SU)(l),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(l)?l.value=e:null}),placeholder:o.placeholder?o.placeholder:(0,a.SU)(i)("Enter text here...","addonify-wishlist"),size:"large"},null,8,["modelValue","placeholder"])}}},te={__name:"Textarea",props:{modelValue:String,className:String,placeholder:String},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=wp.i18n.__,l=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(t,n){return(0,a.wg)(),(0,a.j4)((0,a.SU)(J.EZ),{modelValue:(0,a.SU)(l),"onUpdate:modelValue":n[0]||(n[0]=function(e){return(0,a.dq)(l)?l.value=e:null}),class:(0,a.C_)(e.className),type:"textarea",rows:"10",placeholder:o.placeholder?o.placeholder:(0,a.SU)(i)("Enter text here...","addonify-wishlist"),resize:"vertical","input-style":"display:block;width: 100%;"},null,8,["modelValue","class","placeholder"])}}};var ne=n(3379),ae=n.n(ne),oe=n(2306),ie={insert:"head",singleton:!1};ae()(oe.Z,ie);oe.Z.locals;const le=te,re={__name:"Number",props:{modelValue:[String,Number],min:Number,max:Number},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return parseInt(o.modelValue)},set:function(e){n("update:modelValue",e)}}),l=o.min,r=o.max;return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(J.EZ),{type:"number",modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null}),min:(0,a.SU)(l)?(0,a.SU)(l):0,max:(0,a.SU)(r)},null,8,["modelValue","min","max"])}}};var se=n(49);n(786),n(96);const ce={__name:"Select",props:{modelValue:[Number,String,Array],choices:[Object,Array],placeholder:String},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=wp.i18n.__,l=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(se.km),{modelValue:(0,a.SU)(l),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(l)?l.value=e:null}),placeholder:o.placeholder?o.placeholder:(0,a.SU)(i)("Select","addonify-wishlist"),size:"large"},{default:(0,a.w5)((function(){return[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(o.choices,(function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(se.BT),{label:e,value:t},null,8,["label","value"])})),256))]})),_:1},8,["modelValue","placeholder"])}}};var ue=n(1777),de={insert:"head",singleton:!1};ae()(ue.Z,de);ue.Z.locals;const fe=ce;var pe=n(4509);n(7499);const me={__name:"Checkbox",props:{modelValue:[Boolean],label:[String]},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(pe.Xb),{modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null}),label:"{{props.label}}",size:"large"},null,8,["modelValue"])}}};n(6767),n(8588);const ve={__name:"CheckboxButton",props:{modelValue:[Array],choices:Object},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(pe.z5),{modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null}),size:"large"},{default:(0,a.w5)((function(){return[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(o.choices,(function(e,t){return(0,a.wg)(),(0,a.j4)((0,a.SU)(pe.lm),{label:t},{default:(0,a.w5)((function(){return[(0,a.Uk)((0,a.zw)(e),1)]})),_:2},1032,["label"])})),256))]})),_:1},8,["modelValue"])}}};var Ce=n(2076);n(5496),n(9298);const _e={__name:"Radio",props:{modelValue:String,choices:[Object,Array]},emits:["update:modelValue"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return o.modelValue},set:function(e){n("update:modelValue",e)}});return function(e,t){return(0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(o.choices,(function(e,n){return(0,a.wg)(),(0,a.j4)((0,a.SU)(Ce.KD),{modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null})},{default:(0,a.w5)((function(){return[(0,a.Wm)((0,a.SU)(Ce.rh),{label:n},{default:(0,a.w5)((function(){return[(0,a.Uk)((0,a.zw)(e),1)]})),_:2},1032,["label"])]})),_:2},1032,["modelValue"])})),256)}}};var we=n(2145),ye=(n(9910),{key:0,class:"label"});const he={__name:"ColorPicker",props:{colorVal:String,isAlpha:Boolean,label:String},emits:["update:colorVal"],setup:function(e,t){var n=t.emit,o=e,i=(0,a.Fl)({get:function(){return o.colorVal},set:function(e){n("update:colorVal",e)}});return function(e,t){return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a.Wm)((0,a.SU)(we.$),{modelValue:(0,a.SU)(i),"onUpdate:modelValue":t[0]||(t[0]=function(e){return(0,a.dq)(i)?i.value=e:null}),"show-alpha":o.isAlpha},null,8,["modelValue","show-alpha"]),o.label?((0,a.wg)(),(0,a.iD)("span",ye,(0,a.zw)(o.label),1)):(0,a.kq)("",!0)],64)}}};var ge=n(2740),Ve={insert:"head",singleton:!1};ae()(ge.Z,Ve);ge.Z.locals;const Se=he;var be={class:"unsupported-control-text"},ke={href:"https://docs.addonify.com/kb/woocommerce-quick-view/developer/",target:"_blank",rel:"documentation",class:"adfy-button fake-button has-underline forward-to-doc-link"};const Ue={__name:"InvalidControl",setup:function(e){var t=wp.i18n.__;return function(e,n){return(0,a.wg)(),(0,a.iD)("span",be,[(0,a.Uk)(" ❌ "+(0,a.zw)((0,a.SU)(t)("Input is not supported.","addonify-wishist"))+" ",1),(0,a._)("a",ke,(0,a.zw)((0,a.SU)(t)("Check docs","addonify-wishist")),1)])}}};var He=n(1274),ze={insert:"head",singleton:!1};ae()(He.Z,ze);He.Z.locals;const xe=Ue,Le={__name:"InputControl",props:{field:Object,fieldKey:String,label:String,reactiveState:Object},setup:function(e){var t=e;return function(e,n){return"switch"==t.field.type?((0,a.wg)(),(0,a.j4)(X,{key:0,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[0]||(n[0]=function(e){return t.reactiveState[t.fieldKey]=e})},null,8,["modelValue"])):"select"==t.field.type?((0,a.wg)(),(0,a.j4)(fe,{key:1,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[1]||(n[1]=function(e){return t.reactiveState[t.fieldKey]=e}),choices:t.field.choices,placeholder:t.field.placeholder},null,8,["modelValue","choices","placeholder"])):"text"==t.field.type?((0,a.wg)(),(0,a.j4)(ee,{key:2,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[2]||(n[2]=function(e){return t.reactiveState[t.fieldKey]=e}),placeholder:t.field.placeholder},null,8,["modelValue","placeholder"])):"textarea"==t.field.type?((0,a.wg)(),(0,a.j4)(le,{key:3,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[3]||(n[3]=function(e){return t.reactiveState[t.fieldKey]=e}),placeholder:t.field.placeholder},null,8,["modelValue","placeholder"])):"checkbox"==t.field.type&&"buttons"==t.field.typeStyle?((0,a.wg)(),(0,a.j4)(ve,{key:4,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[4]||(n[4]=function(e){return t.reactiveState[t.fieldKey]=e}),choices:t.field.choices},null,8,["modelValue","choices"])):"checkbox"==t.field.type?((0,a.wg)(),(0,a.j4)(me,{key:5,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[5]||(n[5]=function(e){return t.reactiveState[t.fieldKey]=e}),choices:t.field.choices},null,8,["modelValue","choices"])):"number"==t.field.type?((0,a.wg)(),(0,a.j4)(re,{key:6,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[6]||(n[6]=function(e){return t.reactiveState[t.fieldKey]=e}),placeholder:t.field.placeholder},null,8,["modelValue","placeholder"])):"radio"==t.field.type?((0,a.wg)(),(0,a.j4)(_e,{key:7,modelValue:t.reactiveState[t.fieldKey],"onUpdate:modelValue":n[7]||(n[7]=function(e){return t.reactiveState[t.fieldKey]=e}),choices:t.field.choices},null,8,["modelValue","choices"])):"color"==t.field.type?((0,a.wg)(),(0,a.j4)(Se,{key:8,colorVal:t.reactiveState[t.fieldKey],"onUpdate:colorVal":n[8]||(n[8]=function(e){return t.reactiveState[t.fieldKey]=e}),isAlpha:t.field.isAlpha,label:t.field.label},null,8,["colorVal","isAlpha","label"])):((0,a.wg)(),(0,a.j4)(xe,{key:9}))}}};var Ze=n(4788),je=(n(7903),{class:"adfy-options"}),Me={class:"adfy-col left"},De={class:"label"},Ke={key:0,class:"option-label"},qe={key:1,class:"option-description"},Oe={class:"adfy-col right"},We={class:"input"};const Fe={__name:"OptionBox",props:{section:Object,sectionKey:[String,Object],reactiveState:Object},setup:function(e){var t=e;return function(e,n){return(0,a.wg)(),(0,a.iD)(a.HY,null,[(0,a.WI)(e.$slots,"default"),((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(t.section.fields,(function(e,n){return(0,a.wg)(),(0,a.iD)("div",je,[(0,a._)("div",{class:(0,a.C_)(["adfy-option-columns option-box",e.className])},[(0,a._)("div",Me,[(0,a._)("div",De,[e.label?((0,a.wg)(),(0,a.iD)("p",Ke,[(0,a.Uk)((0,a.zw)(e.label)+" ",1),e.hasOwnProperty("badge")?((0,a.wg)(),(0,a.j4)((0,a.SU)(Ze.Ks),{key:0,type:e.badgeType?e.badgeType:""},{default:(0,a.w5)((function(){return[(0,a.Uk)((0,a.zw)(e.badge),1)]})),_:2},1032,["type"])):(0,a.kq)("",!0)])):(0,a.kq)("",!0),e.description?((0,a.wg)(),(0,a.iD)("p",qe,(0,a.zw)(e.description),1)):(0,a.kq)("",!0)])]),(0,a._)("div",Oe,[(0,a._)("div",We,[(0,a.Wm)(Le,{field:e,fieldKey:n,reactiveState:t.reactiveState},null,8,["field","fieldKey","reactiveState"])])])],2)])})),256))],64)}}},Ae={__name:"OptionSection",props:{className:String},setup:function(e){var t=e;return function(e,n){return(0,a.wg)(),(0,a.iD)("section",{class:(0,a.C_)(["adfy-options-section",t.className])},[(0,a.WI)(e.$slots,"default")],2)}}};var Ne={class:"adfy-container"},Be={class:"adfy-columns main-content"},Ye={class:"adfy-col start site-secondary"},Ie={class:"adfy-col end site-primary"};var Ee={class:"adfy-options"},Te={class:"adfy-option-columns option-box fullwidth"},Pe={class:"adfy-col left"},Ge={class:"label"},$e={key:0,class:"option-label"},Qe={key:1,class:"option-description"},Re={class:"adfy-col right"},Xe={class:"input-group"},Je={class:"input"};const et={__name:"ColorGroup",props:{section:Object,reactiveState:Object},setup:function(e){var t=e;return function(e,n){return(0,a.wg)(),(0,a.iD)("div",Ee,[(0,a._)("div",Te,[(0,a._)("div",Pe,[(0,a._)("div",Ge,[""!==t.section.title?((0,a.wg)(),(0,a.iD)("p",$e,(0,a.zw)(t.section.title),1)):(0,a.kq)("",!0),""!==t.section.description?((0,a.wg)(),(0,a.iD)("p",Qe,(0,a.zw)(t.section.description),1)):(0,a.kq)("",!0)])]),(0,a._)("div",Re,[(0,a._)("div",Xe,[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(t.section.fields,(function(e,n){return(0,a.wg)(),(0,a.iD)("div",Je,[(0,a.Wm)(Le,{field:e,fieldKey:n,label:e.label,reactiveState:t.reactiveState},null,8,["field","fieldKey","label","reactiveState"])])})),256))])])])])}}};var tt={class:"adfy-ui-option"};const nt={__name:"HandleDesignOptions",props:{section:Object,reactiveState:Object},setup:function(e){var t=e;return function(e,n){return(0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)(t.section,(function(e,n){return(0,a.wg)(),(0,a.iD)("div",tt,["color-options-group"==e.type?((0,a.wg)(),(0,a.j4)(et,{key:0,section:e,reactiveState:t.reactiveState},null,8,["section","reactiveState"])):((0,a.wg)(),(0,a.j4)(Fe,{key:1,section:e,reactiveState:t.reactiveState},{default:(0,a.w5)((function(){return[(0,a.Wm)($,{section:e,sectionKey:n},null,8,["section","sectionKey"])]})),_:2},1032,["section","reactiveState"]))])})),256)}}};var at={class:"adfy-container"},ot={class:"adfy-columns main-content"},it={class:"adfy-col start site-secondary"},lt={class:"adfy-col end site-primary"};var rt={class:"adfy-container"},st={class:"adfy-columns main-content"},ct={class:"adfy-col start aside secondary"},ut={class:"adfy-col end site-primary"};var dt={class:"error-404"};var ft=[{path:"/",name:"Settings",component:{__name:"Settings",setup:function(e){var t=f();return(0,a.bv)((function(){t.fetchOptions()})),function(e,n){return(0,a.wg)(),(0,a.iD)("section",Ne,[(0,a._)("main",Be,[(0,a._)("aside",Ye,[(0,a.Wm)(E)]),(0,a._)("section",Ie,[(0,a.SU)(t).isLoading?((0,a.wg)(),(0,a.j4)(F,{key:0})):((0,a.wg)(),(0,a.j4)(P,{key:1,divId:"adfy-settings-form"},{default:(0,a.w5)((function(){return[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)((0,a.SU)(t).data.settings.sections,(function(e,n){return(0,a.wg)(),(0,a.j4)(Ae,null,{default:(0,a.w5)((function(){return[(0,a.Wm)(Fe,{section:e,sectionKey:n,reactiveState:(0,a.SU)(t).options},{default:(0,a.w5)((function(){return[(0,a.Wm)($,{section:e,sectionkey:n},null,8,["section","sectionkey"])]})),_:2},1032,["section","sectionKey","reactiveState"])]})),_:2},1024)})),256))]})),_:1}))])])])}}}},{path:"/styles",name:"Styles",component:{__name:"Styles",setup:function(e){var t=f();return(0,a.bv)((function(){t.fetchOptions()})),function(e,n){return(0,a.wg)(),(0,a.iD)("section",at,[(0,a._)("main",ot,[(0,a._)("aside",it,[(0,a.Wm)(E)]),(0,a._)("section",lt,[(0,a.SU)(t).isLoading?((0,a.wg)(),(0,a.j4)(F,{key:0})):((0,a.wg)(),(0,a.j4)(P,{key:1,divId:"adfy-style-options-form"},{default:(0,a.w5)((function(){return[((0,a.wg)(!0),(0,a.iD)(a.HY,null,(0,a.Ko)((0,a.SU)(t).data.styles,(function(e,n){return(0,a.wg)(),(0,a.j4)(Ae,null,{default:(0,a.w5)((function(){return[(0,a.Wm)(nt,{section:e,reactiveState:(0,a.SU)(t).options},{default:(0,a.w5)((function(){return[(0,a.Wm)($,{section:e,sectionkey:n},null,8,["section","sectionkey"])]})),_:2},1032,["section","reactiveState"])]})),_:2},1024)})),256))]})),_:1}))])])])}}}},{path:"/products",name:"Products",component:{__name:"Products",setup:function(e){var t=wp.i18n.__;return function(e,n){return(0,a.wg)(),(0,a.iD)("section",rt,[(0,a._)("main",st,[(0,a._)("aside",ct,[(0,a.Wm)(E)]),(0,a._)("section",ut,[(0,a._)("p",null,(0,a.zw)((0,a.SU)(t)("Coming soon.....","addonify-quick-view")),1)])])])}}}},{path:"/:catchAll(.*)*",name:"404",component:{__name:"404",setup:function(e){var t=wp.i18n.__;return function(e,n){var o=(0,a.up)("router-link");return(0,a.wg)(),(0,a.iD)("div",dt,[(0,a._)("h3",null,(0,a.zw)((0,a.SU)(t)("404","addonify-quick-view")),1),(0,a._)("p",null,(0,a.zw)((0,a.SU)(t)("Oops, page not found!","addonify-quick-view")),1),(0,a.Wm)(o,{to:"/",class:"adfy-button"},{default:(0,a.w5)((function(){return[(0,a.Uk)((0,a.zw)((0,a.SU)(t)("Go Back","addonify-quick-view")),1)]})),_:1})])}}}}];const pt=(0,K.p7)({history:(0,K.r5)(),routes:ft});var mt=(0,o.WB)(),vt=(0,a.ri)(D);vt.use(mt),vt.use(pt),vt.mount("#___adfy-quickview-app___")}},e=>{var t=t=>e(e.s=t);e.O(0,[703,898],(()=>(t(2403),t(7218))));e.O()}]);