import {
    Navbar,
    NavbarBrand,
    NavbarCollapse,
    NavbarLink,
    NavbarToggle,
} from "flowbite-react";

export default function NavBar() {
    return (
        <Navbar fluid rounded>
            <NavbarBrand href="https://flowbite-react.com">
                <img
                    src="https://flowbite.com/docs/images/logo.svg"
                    className="mr-3 h-6 sm:h-9"
                    alt="Flowbite React Logo"
                />
                <span className="self-center whitespace-nowrap text-xl font-semibold dark:text-white">
                    NGELAN TOUR
                </span>
            </NavbarBrand>
            <NavbarToggle />
            <NavbarCollapse>
                <NavbarLink>Favorite</NavbarLink>
                <NavbarLink>Booked Hotel</NavbarLink>
                <NavbarLink>Login</NavbarLink>
                <NavbarLink>Register</NavbarLink>
            </NavbarCollapse>
        </Navbar>
    );
}
