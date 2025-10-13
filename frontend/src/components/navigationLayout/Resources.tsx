import React from "react";
import woodIcon from "../../assets/img/icon/icon_wood.png";
import wineIcon from "../../assets/img/icon/icon_wine.png";
import marbleIcon from "../../assets/img/icon/icon_marble.png";
import glassIcon from "../../assets/img/icon/icon_glass.png";
import sulfurIcon from "../../assets/img/icon/icon_sulfur.png";
import { useTranslation } from "react-i18next";
import { Resources } from "@shared/types/models";

interface ResourcesProps extends Resources {

}

const Resources: React.FC<ResourcesProps> = ({wood, wine, marble, glass, sulfur}) => {
    const { t } = useTranslation();

    return (
        <div className="flex-1 flex select-none pl-[5px]">
            <div className="flex-1 flex items-center" title={t("resources.wood")}>
                <img className="mr-1" src={woodIcon} />
                <span>{wood}</span>
            </div>

            <div className="flex-1 flex items-center" title={t("resources.wine")}>
                <img className="mr-1" src={wineIcon} />
                <span>{wine}</span>
            </div>

            <div className="flex-1 flex items-center" title={t("resources.marble")}>
                <img className="mr-1" src={marbleIcon} />
                <span>{marble}</span>
            </div>

            <div className="flex-1 flex items-center" title={t("resources.glass")}>
                <img className="mr-1" src={glassIcon} />
                <span>{glass}</span>
            </div>

            <div className="flex-1 flex items-center" title={t("resources.sulfur")}>
                <img className="mr-1" src={sulfurIcon} />
                <span>{sulfur}</span>
            </div>
        </div>
    );
};

export default Resources;