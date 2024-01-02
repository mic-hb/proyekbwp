import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import { usePage } from "@inertiajs/react";
import { Carousel } from "flowbite-react";
import Rating from "@/components/rating";

export default function detailHotel() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotel, setHotel] = useState({});
    const roomCode = usePage().props.id;
    const [image_urls, setImage_urls] = useState([]);
    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelDetailRequest = await api.get(`/hotel/${roomCode}`);

            try {
                const [hotelResponse] = await Promise.all([
                    hotelDetailRequest.data,
                ]);
                setHotel(hotelResponse[0]);
                hotelResponse[0].image_urls.map((image) => {
                    image_urls.push(image);
                });
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, [setHotel]);

    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="flex flex-col gap-8 w-full">
                <div className="flex flex-col w-full gap-2">
                    <div className="flex flex-col w-full">
                        <div className="flex w-full aspect-video">
                            <Carousel pauseOnHover slideInterval={2500}>
                                {image_urls.map((image, index) => (
                                    <img key={index} src={image} alt="..." />
                                ))}
                            </Carousel>
                        </div>
                        <div className="flex flex-col justify-center p-4">
                            <h1 className="text-2xl font-bold">{hotel.name}</h1>
                            <Rating rating={hotel.average_rating} />
                            <p>{hotel.address}</p>
                            <p>{hotel.city_name}</p>
                            <button className="px-4 p-2 bg-green-400 rounded-md mt-4 hover:bg-green-500 font-semibold text-xl">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </GeneralLayout>
    );
}
