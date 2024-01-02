
import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import Search from "@/components/filter";
import Card from "@/components/card";
import { usePage } from "@inertiajs/react";

export default function index() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotels, setHotels] = useState([]);
    const id = usePage().props.id;

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            // const hotelRequest = await api.get("/allHotels", {
            //     params: {
            //         skip: 0,
            //         take: 5,
            //     },
            // });
            const hotelDetailsRequest = await api.get(`/hotel/${id}`);

            try {
                const [hotelResponse] = await Promise.all([hotelDetailsRequest.data]);
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
    );
}
