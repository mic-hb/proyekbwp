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
            <NavbarBrand href="/">
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
                <NavbarLink href="/hotels">Hotels</NavbarLink>
                <NavbarLink href="/favourites">Favorite</NavbarLink>
                <NavbarLink href="">Booked Hotel</NavbarLink>
                <NavbarLink href="/login">Login</NavbarLink>
                <NavbarLink href="/register">Register</NavbarLink>
            </NavbarCollapse>
        </Navbar>
    );
}
