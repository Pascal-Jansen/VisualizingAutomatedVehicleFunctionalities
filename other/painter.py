import openpifpaf


class BoxPainter(openpifpaf.show.DetectionPainter):
    """Painter for bounding boxes of detected instances.

    Args:
        xy_scale (float): Scale factor for display.
    """

    def __init__(self, *, xy_scale: float = 1.0):
        super().__init__(xy_scale=xy_scale)


    def annotation(self, ax, ann, *, color=None, text=None, subtext=None):
        assert 'center' in ann.attributes
        assert 'width' in ann.attributes
        assert 'height' in ann.attributes
        anndet = openpifpaf.annotation.AnnotationDet([]).set(0, 0.,
            [ann.attributes['center'][0]-.5*ann.attributes['width'],
             ann.attributes['center'][1]-.5*ann.attributes['height'],
             ann.attributes['width'], ann.attributes['height']])

        if text is None:
            text = ann.object_type.name
        if subtext is None:
            if getattr(ann, 'id', None): # ground truth annotation
                subtext = ann.id
            elif ('will_cross' in ann.attributes and 'is_corssing' in ann.attributes): # prediction
                subtext = '{:.0%}'.format(ann.attributes['will_cross'])

        willC = float(ann.attributes['will_cross'])
        isC = float(ann.attributes['is_crossing'])
        confi = float(ann.attributes['confidence'])

        intention = -1
        if(isC > 0.275 or willC > 0.275):
            intention = 1 #Pedestrian will probably cross
        elif(isC < 0.275 or willC < 0.275):
            intention = 2 #Pedestrian will not cross
        if(isC > 0.3):
            intention = 3 #Pedestrian is crossing       
        subtext = intention

        if(confi < 0.5):
            subtext = -1

        super().annotation(ax, anndet, color=color, text=text, subtext=subtext)
