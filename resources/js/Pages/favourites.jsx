import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import Card from "@/components/card";

export default function favourites() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelRequest = await api.get("/allHotels", {
                params: {
                    skip: 0,
                    take: 10,
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
            <div className="flex flex-col gap-4 w-full items-center">
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
        </GeneralLayout>
    );
}
