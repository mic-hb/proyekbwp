import GeneralLayout from "@/layouts/general";
import Search from "@/components/filter";
import { useState, useEffect } from "react";
import api from "@/api";
import Card from "@/components/card";

import {
    Navbar,
    NavbarBrand,
    NavbarCollapse,
    NavbarLink,
    NavbarToggle,
} from "flowbite-react";
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
        <GeneralLayout>
            <div className="flex flex-col gap-4">
                <Search />
                <div className="flex flex-col gap-4">
                    <h1 className="text-2xl font-semibold">Top 5 Favourites</h1>
                    <div className="flex flex-col gap-2">
                        {hotels.map((hotel) => (
                            <Card
                                key={hotel.code}
                                code={hotel.code}
                                image="https://flowbite.com/docs/images/blog/image-1.jpg"
                                title={hotel.name}
                                address={hotel.address}
                                city={hotel.city_name}
                                rating="4"
                                price="599"
                                action="Book Now"
                            />
                        ))}
                    </div>
                </div>
                <div className="flex flex-col gap-4">
                    <h1 className="text-2xl font-semibold">Top 5 by Reviews</h1>
                    <div className="flex flex-col gap-2">
                        {hotels.map((hotel) => (
                            <Card
                                key={hotel.code}
                                code={hotel.code}
                                image="https://flowbite.com/docs/images/blog/image-1.jpg"
                                title={hotel.name}
                                address={hotel.address}
                                city={hotel.city_name}
                                rating="4"
                                price="599"
                                action="Book Now"
                            />
                        ))}
                    </div>
                </div>
            </div>
        </GeneralLayout>
    );
}
