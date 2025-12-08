 <footer
     class="gt-footer-section fix bg-cover"
     style="background-image: url('/assets/guest/img/home-1/footer/footer-img.jpg')">
     <div class="container">
         <div class="gt-footer-widget-wrapper-2">
             <div class="row g-4">
                 <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                     <div class="footer-left">
                         <a href="index.html" class="footer-logo">
                             <img src="<?= handleFilePath(\Http\Services\SettingService::getLogo("/assets/guest/img/logo/white-logo.svg")["logo"]) ?>" alt="img" />
                         </a>
                         <p>
                             Welcome to Handog Resort, your sanctuary of relaxation and escape. Surrounded by nature&apos;s beauty and designed with comfort in mind, our resort offers the perfect blend of luxury and serenity. Whether you&apos;re here for a family getaway, a celebration, or simply to unwind, Handog Resort is where unforgettable memories begin.
                         </p>
                         <ul class="contact-list">
                             <li>
                                 <img src="/assets/guest/img/home-1/footer/call.svg" alt="img" />
                                 <a href="tel:<?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?>"><?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?></a>
                             </li>
                             <li>
                                 <img src="/assets/guest/img/home-1/footer/email.svg" alt="img" />
                                 <a href="mailto:<?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>"><?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?></a>
                             </li>
                         </ul>
                         <ul class="footer-menu-list">
                             <li>
                                 <a href="/">Home</a>
                             </li>
                             <li>
                                 <a href="/accommodation">Accommodation</a>
                             </li>
                             <li>
                                 <a href="/amenities">Amenities</a>
                             </li>
                             <li>
                                 <a href="/gallery">Gallery</a>
                             </li>
                             <li>
                                 <a href="/about">About</a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                     <div class="footer-right-items">
                         <div class="row g-4">
                             <div class="col-lg-6">
                             </div>
                             <div class="col-lg-6 col-md-6">
                                 <div class="footer-widget-items">
                                     <h3 class="widget-title">Philippines</h3>
                                     <ul class="gt-contact-list">
                                         <li>
                                             <img
                                                 src="/assets/guest/img/home-1/footer/location.svg"
                                                 alt="img" />
                                             <p><?= \Http\Services\ContactDetailService::getContactDetails()["address"] ?></p>
                                         </li>
                                         <li>
                                             <img
                                                 src="/assets/guest/img/home-1/footer/email.svg"
                                                 alt="img" />
                                             <a href="mailto:<?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>">
                                                 <?= \Http\Services\ContactDetailService::getContactDetails()["email"] ?>
                                             </a>
                                         </li>
                                         <li>
                                             <img
                                                 src="/assets/guest/img/home-1/footer/call.svg"
                                                 alt="img" />
                                             <a href="tel:<?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?>"><?= \Http\Services\ContactDetailService::getContactDetails()["contact_no"] ?></a>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>