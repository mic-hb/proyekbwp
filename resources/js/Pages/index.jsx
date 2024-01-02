<<<<<<< Updated upstream
import React from "react";
import {
    Navbar,
    NavbarBrand,
    NavbarCollapse,
    NavbarLink,
    NavbarToggle,
} from "flowbite-react";
// import { Navbar } from "flowbite-react";
import { Head } from "@inertiajs/react";
<Head>
    <title>Index</title>
</Head>;

export default function index({ listBuku }) {
    console.log(listBuku);
    return (
        <Navbar fluid rounded>
            <NavbarBrand href="https://flowbite-react.com">
                <img
                    src="/favicon.svg"
                    className="mr-3 h-6 sm:h-9"
                    alt="Flowbite React Logo"
                />
                <span className="self-center whitespace-nowrap text-xl font-semibold dark:text-white">
                    Flowbite React
                </span>
            </NavbarBrand>
            <NavbarToggle />
            <NavbarCollapse>
                <NavbarLink href="#" active>
                    Home
                </NavbarLink>
                <NavbarLink href="#">About</NavbarLink>
                <NavbarLink href="#">Services</NavbarLink>
                <NavbarLink href="#">Pricing</NavbarLink>
                <NavbarLink href="#">Contact</NavbarLink>
            </NavbarCollapse>
        </Navbar>
=======
import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import Search from "@/components/filter";
import Card from "@/components/card";
import Spinner from "@/components/spinner";

export default function index() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelRequest = await api.get("/allHotels", {
                params: {
                    skip: 0,
                    take: 5,
                },
            });
            const hotelDetailsRequest = await api.get("/hotel/H001");

            try {
                const [hotelResponse] = await Promise.all([hotelRequest.data]);
                setHotels(hotelResponse);
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchData();
    }, []);
    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="flex flex-col gap-2">
                <Search />
                <div>
                    <h1 className="text-2xl font-bold">Our Top 5 This Far</h1>
                    <div>
                        <div className="flex flex-col gap-2">
                            {hotels.map((hotel) => (
                                <Card
                                    key={hotel.code}
                                    image="https://flowbite.com/docs/images/blog/image-1.jpg"
                                    title={hotel.name}
                                    rating="4"
                                    price="599"
                                    action="Book Now"
                                />
                            ))}
                            <a href="">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </GeneralLayout>
>>>>>>> Stashed changes
    );
}
