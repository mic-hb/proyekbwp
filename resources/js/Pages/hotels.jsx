import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import Spinner from "@/components/spinner";
import Card from "@/components/card";

import { Carousel } from "flowbite-react";

export default function hotels() {
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
            <div>
                <div className="w-full h-96 p-4">
                    <Carousel pauseOnHover>
                        <img
                            src="https://flowbite.com/docs/images/carousel/carousel-1.svg"
                            alt="..."
                        />
                        <img
                            src="https://flowbite.com/docs/images/carousel/carousel-2.svg"
                            alt="..."
                        />
                        <img
                            src="https://flowbite.com/docs/images/carousel/carousel-3.svg"
                            alt="..."
                        />
                        <img
                            src="https://flowbite.com/docs/images/carousel/carousel-4.svg"
                            alt="..."
                        />
                        <img
                            src="https://flowbite.com/docs/images/carousel/carousel-5.svg"
                            alt="..."
                        />
                    </Carousel>
                </div>
                <main className="flex flex-col gap-4 w-full items-center">
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
                </main>
            </div>
        </GeneralLayout>
    );
}
