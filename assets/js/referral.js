let copyIconStyleTimeoutRef = null;

document
  .getElementById("copyReferralIcon")
  .addEventListener("click", function () {
    copyIconStyleTimeoutRef = null;
    navigator.clipboard
      .writeText(document.getElementById("referralLink").textContent)
      .then(() => {
        document.getElementById("copyReferralIcon").classList.add("copied");
        console.log(document.getElementById("copyReferralIcon").classList);
        copyIconStyleTimeoutRef = setTimeout(() => {
          document
            .getElementById("copyReferralIcon")
            .classList.remove("copied");
        }, 2000);
      });
  });

// Copy Coupon Code Functionality
document.querySelectorAll(".copy-coupon-icon").forEach((icon) => {
  icon.addEventListener("click", function () {
    const couponCode = this.previousElementSibling.textContent.trim();
    navigator.clipboard.writeText(couponCode).then(() => {
      this.classList.add("copied");
      setTimeout(() => {
        this.classList.remove("copied");
      }, 2000);
    });
  });
});

// Social Sharing
const referralLink = document.getElementById("referralLink").textContent;
const shareText = "Join me and get exclusive referral rewards!";

// WhatsApp Share
document
  .getElementById("shareWhatsApp")
  .addEventListener("click", function (e) {
    e.preventDefault();
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(shareText + " " + referralLink)}`;
    window.open(whatsappUrl, "_blank");
  });

// Facebook Share
document
  .getElementById("shareFacebook")
  .addEventListener("click", function (e) {
    e.preventDefault();
    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}&quote=${encodeURIComponent(shareText)}`;
    window.open(facebookUrl, "_blank", "width=600,height=400");
  });

// X (Twitter) Share
document.getElementById("shareX").addEventListener("click", function (e) {
  e.preventDefault();
  const xUrl = `https://x.com/intent/tweet?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(shareText)}`;
  window.open(xUrl, "_blank", "width=600,height=400");
});

// Messenger Share
document
  .getElementById("shareMessenger")
  .addEventListener("click", function (e) {
    e.preventDefault();
    const messengerUrl = `fb-messenger://share/?link=${encodeURIComponent(referralLink)}`;
    window.open(messengerUrl, "_blank");
  });
