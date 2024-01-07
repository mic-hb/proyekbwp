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
    const [favoriteHotels, setFavoriteHotels] = useState([]);
    const [reviewHotels, setReviewHotels] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelFavoriteRequest = await api.get("/topFavorites", {
                params: {
                    skip: 0,
                    take: 5,
                },
            });

            const hotelReviewRequest = await api.get("/topReviews", {
                params: {
                    skip: 0,
                    take: 5,
                },
            });

            try {
                const [hotelFavoriteResponse, hotelReviewResponse] = await Promise.all([hotelFavoriteRequest.data, hotelReviewRequest.data]);
                setFavoriteHotels(hotelFavoriteResponse);
                setReviewHotels(hotelReviewResponse);
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
            <div className="flex flex-col gap-4">
                <Search />
                <div className="flex flex-col gap-4">
                    <h1 className="text-2xl font-semibold">Top 5 Favourites</h1>
                    <div className="flex flex-col gap-2">
                        {favoriteHotels.map((hotel) => (
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
                                favorite="Add to Favourites"
                            />
                        ))}
                    </div>
                </div>
                <div className="flex flex-col gap-4">
                    <h1 className="text-2xl font-semibold">Top 5 by Reviews</h1>
                    <div className="flex flex-col gap-2">
                        {reviewHotels.map((hotel) => (
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
                                favorite="Add to Favourites"
                            />
                        ))}
                    </div>
                </div>
            </div>
        </GeneralLayout>
    );
}
