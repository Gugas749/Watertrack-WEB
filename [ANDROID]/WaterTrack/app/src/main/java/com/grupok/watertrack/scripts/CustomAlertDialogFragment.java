package com.grupok.watertrack.scripts;

import android.content.DialogInterface;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.Bundle;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.cardview.widget.CardView;
import androidx.fragment.app.DialogFragment;
import androidx.fragment.app.Fragment;

import com.grupok.watertrack.R;
import com.grupok.watertrack.fragments.alertDialogFragments.AlertDialogQuestionFragment;

import java.util.Date;

public class CustomAlertDialogFragment extends DialogFragment implements
        AlertDialogQuestionFragment.CancelButtonClickQuestionDialog,
        AlertDialogQuestionFragment.ConfirmButtonClickQuestionDialog {
    private Fragment customFragment;
    private ConfirmButtonClickAlertDialogQuestionFrag confirmButtonClickAlertDialogQuestionFrag;
    private CancelButtonClickAlertDialogQuestionFrag cancelButtonClickAlertDialogQuestionFrag;
    private String Tag;
    private int backgroundColor = 0;


    public interface ConfirmButtonClickAlertDialogQuestionFrag{
        void onConfirmButtonClicked(String Tag);
    }


    public interface CancelButtonClickAlertDialogQuestionFrag{
        void onCancelButtonClicked(String Tag);
    }

    private DismissListenner dismissListenner;
    public interface DismissListenner{
        void onDismissListenner();
    }
    public void setDismissListenner(DismissListenner dismissListenner){
        this.dismissListenner = dismissListenner;
    }

    public CustomAlertDialogFragment() {

    }

    public void setTag(String Tag){
        this.Tag = Tag;
    }

    public void setBackgroundColor(int color){
        backgroundColor = color;
    }

    public void setConfirmListenner(ConfirmButtonClickAlertDialogQuestionFrag listenner){
        this.confirmButtonClickAlertDialogQuestionFrag = listenner;
    }

    public void setCancelListenner(CancelButtonClickAlertDialogQuestionFrag listenner){
        this.cancelButtonClickAlertDialogQuestionFrag = listenner;
    }


    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_container_layout_alert_dialog, container, false);
        CardView parent = view.findViewById(R.id.linearLayout_parent_custom_alertDialog);

        if(backgroundColor != 0){
            parent.setCardBackgroundColor(backgroundColor);
        }
        if (getDialog() != null && getDialog().getWindow() != null) {
            getDialog().getWindow().setBackgroundDrawable(new ColorDrawable(Color.TRANSPARENT));
            getDialog().getWindow().requestFeature(Window.FEATURE_NO_TITLE);
        }

        if (customFragment != null) {
            getChildFragmentManager().beginTransaction()
                    .replace(R.id.fragment_container_custom_alertDialog, customFragment)
                    .commit();
        }
        disableBackPressed(view);

        return view;
    }
    private void disableBackPressed(View view){
        view.setFocusableInTouchMode(true);
        view.requestFocus();
        view.setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode, KeyEvent event) {
                if (keyCode == KeyEvent.KEYCODE_BACK && event.getAction() == KeyEvent.ACTION_UP) {
                    return true;
                }
                return false;
            }
        });
    }
    @Override
    public void onDismiss(DialogInterface dialog) {
        super.onDismiss(dialog);

        if(dismissListenner != null){
            dismissListenner.onDismissListenner();
        }
    }

    public void setCustomFragment(Fragment customFragment){
        this.customFragment = customFragment;
    }

    @Override
    public void onCancelButtonClickedQuestionDialog() {
        cancelButtonClickAlertDialogQuestionFrag.onCancelButtonClicked(Tag);
        this.dismiss();
    }

    @Override
    public void onConfirmButtonClickedQuestionDialog() {
        confirmButtonClickAlertDialogQuestionFrag.onConfirmButtonClicked(Tag);
        this.dismiss();
    }
}
