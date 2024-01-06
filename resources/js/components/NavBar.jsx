import {
    Navbar,
    NavbarBrand,
    NavbarCollapse,
    NavbarLink,
    NavbarToggle,
} from "flowbite-react";
import { useState, useEffect } from "react";
import api from "@/api";

export default function NavBar() {
    const [isLoggedIn, setIsLoggedIn] = useState(false);

    useEffect(() => {
        const fetchData = async () => {
            const loginCheckRequest = await api.get(`/checkLogin`);

            try {
                const [loginCheckResponse] = await Promise.all([
                    loginCheckRequest.data,
                ]);
                if (loginCheckResponse.status === true) {
                    setIsLoggedIn(true);
                }
            } catch (error) {
                console.log(error);
            } finally {
            }
        };
        fetchData();
    }, []);

    const handleLogout = async () => {
        // setIsLoading(true);

        try {
            const logoutRequest = await api.get("/logout");
            const logoutResponse = logoutRequest.data;

            if (logoutResponse.status === true) {
                console.log(logoutResponse.message);
                alert(logoutResponse.message);

                window.location.href = "/";
            }
        } catch (error) {
            console.log(error);
        } finally {
            // setIsLoading(false);
        }
    };

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
                {isLoggedIn ? (
                    <NavbarLink
                        className="hover:cursor-pointer"
                        onClick={handleLogout}
                    >
                        Logout
                    </NavbarLink>
                ) : (
                    <>
                        <NavbarLink href="/login">Login</NavbarLink>
                        <NavbarLink href="/register">Register</NavbarLink>
                    </>
                )}
            </NavbarCollapse>
        </Navbar>
    );
}
