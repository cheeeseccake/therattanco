document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById("menu-toggle");
    const primaryNav = document.getElementById("primary-nav");

    const userBtn = document.getElementById("user-btn");
    const dropdown = document.getElementById("dropdown-menu");

    // Mobile navigation
    if (menuToggle && primaryNav) {
        menuToggle.addEventListener("click", () => {
            const isOpen = primaryNav.classList.toggle("open");

            menuToggle.setAttribute(
                "aria-expanded",
                String(isOpen)
            );

            menuToggle.setAttribute(
                "aria-label",
                isOpen
                    ? "Close navigation menu"
                    : "Open navigation menu"
            );

            menuToggle.innerHTML = isOpen
                ? '<i class="fa-solid fa-xmark" aria-hidden="true"></i>'
                : '<i class="fa-solid fa-bars" aria-hidden="true"></i>';
        });

        // Close the mobile menu after selecting a section
        primaryNav.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                primaryNav.classList.remove("open");

                menuToggle.setAttribute("aria-expanded", "false");
                menuToggle.setAttribute(
                    "aria-label",
                    "Open navigation menu"
                );

                menuToggle.innerHTML =
                    '<i class="fa-solid fa-bars" aria-hidden="true"></i>';
            });
        });
    }

    // Account dropdown
    if (userBtn && dropdown) {
        userBtn.addEventListener("click", (event) => {
            event.stopPropagation();

            const isOpen =
                userBtn.getAttribute("aria-expanded") === "true";

            userBtn.setAttribute(
                "aria-expanded",
                String(!isOpen)
            );

            dropdown.hidden = isOpen;
        });

        // Close dropdown when clicking elsewhere
        document.addEventListener("click", (event) => {
            if (!event.target.closest(".user-menu")) {
                dropdown.hidden = true;
                userBtn.setAttribute("aria-expanded", "false");
            }
        });

        // Close dropdown with Escape
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                dropdown.hidden = true;
                userBtn.setAttribute("aria-expanded", "false");
                userBtn.focus();
            }
        });
    }
});
