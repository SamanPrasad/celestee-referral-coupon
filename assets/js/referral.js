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
