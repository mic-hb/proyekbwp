import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import Card from "@/components/card";

import { Carousel } from "flowbite-react";

export default function hotels() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);
    const [favoriteHotels, setFavoriteHotels] = useState([]);


    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelRequest = await api.get("/allHotels", {
                params: {
                    skip: 0,
                    take: 10,
                },
            });

            const hotelFavoriteRequest = await api.get("/topFavorites", {
                params: {
                    skip: 0,
                    take: 5,
                },
            });

            try {
                const [hotelResponse, hotelFavoriteResponse] = await Promise.all([hotelRequest.data, hotelFavoriteRequest.data]);
                setHotels(hotelResponse);
                setFavoriteHotels(hotelFavoriteResponse);
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
            <div className="w-full">
                <div className="w-full h-96 p-4">
                    <Carousel pauseOnHover>
                        {favoriteHotels.map((hotel) => (
                            <a key={hotel.code} href={`/hotel/${hotel.code}`}>
                                <img src={hotel.image_urls[0]} alt="" />
                            </a>
                        ))}
                    </Carousel>
                </div>
                <main className="flex flex-col gap-4 w-full items-center">
                    {hotels.map((hotel) => (
                        <Card
                            key={hotel.code}
                            code={hotel.code}
                            image={hotel.image_urls[0]}
                            title={hotel.name}
                            address={hotel.address}
                            city={hotel.city_name}
                            rating={hotel.average_rating}
                            price={hotel.lowest_price}
                            action="Book Now"
                            favorite="Add to Favorite"
                        />
                    ))}
                </main>
            </div>
        </GeneralLayout>
    );
}
